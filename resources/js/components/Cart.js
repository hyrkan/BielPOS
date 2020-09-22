import React, { Component } from 'react'
import ReactDOM from "react-dom";
import axios from 'axios';
import { sum } from "lodash";
import Swal from "sweetalert2";
export default class Cart extends Component {


    constructor(props){
        super(props);
        this.state = {
            cart:[],
            products: [],
            total: 0,
            num_low_stocks : 0,
            num_transactions: 0,
            barcode: '',
            id: '',
            quantity: '',
            showHide : false,
        }

        this.handleBarcode = this.handleBarcode.bind(this);
        this.handleScanBarcode = this.handleScanBarcode.bind(this);
        this.handlePush = this.handlePush.bind(this);
        this.removeProd = this.removeProd.bind(this);
        this. removeProd = this. removeProd.bind(this);
        this.emptyCart = this.emptyCart.bind(this);
        this.addQuantity = this.addQuantity.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this. getLowStocks = this. getLowStocks.bind(this);
        this.transactNow = this.transactNow.bind(this);
        this.totalPrice = this.totalPrice.bind(this);
        this.getTotal = this.getTotal.bind(this);
        this.addToCart = this.addToCart.bind(this);
        this.getAllProducts = this.getAllProducts.bind(this);
    }

    componentDidMount(){
        this.getAllProducts();
        this.getLowStocks();
        this.transactNow();
    }


    getAllProducts(){
        axios.get('http://127.0.0.1:8000/getAllproduct')
        .then(res => this.setState({products:res.data})
        ,setTimeout(function() {
            const script = document.createElement("script");
            script.src = '../js/datatable.js';
            script.async = true;
            document.body.appendChild(script);
        }.bind(this), 500)
        );
    }

    getLowStocks(){
        axios.get("http://127.0.0.1:8000/getLowStock")
        .then(res => {
          this.setState({num_low_stocks:res.data})
        }).catch(err => {
            
        })
    }

    transactNow(){
        axios.get("http://127.0.0.1:8000/getTransact")
        .then(res => {
          this.setState({num_transactions:res.data})
        }).catch(err => {
            
        })
    }

    handleBarcode(event){
        const barcode = event.target.value;
        this.setState({barcode});
    }


    handleScanBarcode(event) {
        event.preventDefault();
        const { barcode } = this.state;
        
        if (!!barcode) {
            axios
                .post("http://127.0.0.1:8000/getProduct", { barcode })
                .then(res => {
                    this.handlePush(res.data);
                    this.setState({ barcode: "" });
                })
                .catch(err => {
                    Swal.fire("Error!", "Product Not Found", "error");
                });
        }

    }


    handlePush(item){
        if(item.length > 0){
                let newArray = [...item];
                newArray[0] = {...newArray[0], quantity: 1};
                const found = this.state.cart.some(c => c.id === newArray[0].id);

                if(!found){
                    this.setState({cart: this.state.cart.concat(newArray)});
                    
                }else{
                    const elementsIndex = this.state.cart.findIndex(element => element.id == item[0].id )
                    let newArray = [...this.state.cart];
                    newArray[elementsIndex] = {...newArray[elementsIndex], quantity: newArray[elementsIndex].quantity + 1};
                    this.setState({cart: newArray});
                }

        }else{
            Swal.fire("Error!", "Product Not Found!", "error");
        }
    }

    removeProd(id){

        this.setState({cart: this.state.cart.filter(function(prod) { 
            return prod.id !== id
        })});
    }


    totalPrice(){
        const total = this.state.cart.map(c => c.quantity * c.price);
        this.setState({total:sum(total).toFixed(2)});
    }


    emptyCart(){
        this.setState({cart:[]});
    }

    addQuantity(id){
        const elementsIndex = this.state.cart.findIndex(element => element.id == id)
        let newArray = [...this.state.cart];
        newArray[elementsIndex] = {...newArray[elementsIndex], quantity: newArray[elementsIndex].quantity + 1};
        this.setState({cart: newArray});
    }
    subtractQuantity(id){
        const elementsIndex = this.state.cart.findIndex(element => element.id == id)
        let newArray = [...this.state.cart];
        newArray[elementsIndex] = {...newArray[elementsIndex], quantity: newArray[elementsIndex].quantity - 1};

            if (newArray[elementsIndex].quantity == 0){
                
            }else{
                this.setState({cart: newArray});
            }
        }
       

    getTotal(cart) {
        const total = cart.map(c => c.quantity * c.price);
        return sum(total).toFixed(2);
    }
    
    handleSubmit(){
        const {cart} = this.state;
        if(cart.length > 0){
            Swal.fire({
                title: 'Confirming Transaction',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
              }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Transaction complete',
                        showConfirmButton: false,
                        timer: 1500
                    }),
                    axios.post("http://127.0.0.1:8000/cart_out",{
                        cart : cart,
                        total : this.getTotal(cart)
                    }),
                    
                    this.emptyCart();
                    this.getLowStocks();
                    this.transactNow();
                    this.getAllProducts();

                }
               
            })
            .catch(err => {
                console.log('error');
            });
        }else{
            Swal.fire("Error!", "No Items In The Cart", "error");
        }
    }

    addToCart(val){
        this.setState({barcode:val});
    }
    

    render() {
        const {products, cart, barcode, num_transactions} = this.state;
        return (
            <div>
                <div className="row">
                    <div  className="col-lg-6">
                        <div className="small-box bg-info">
                            <div className="inner">
                                <h3>{num_transactions}</h3>
                
                                <p>Number Of Transactions Today</p>
                            </div>
                        <div className="icon">
                            <i className="fas fa-shopping-cart"></i>
                        </div>
                            <a href="#" className="small-box-footer">More info <i className="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                    <div className="col-lg-6">
                        <div className="small-box bg-danger">
                        <div className="inner">
                            <h3>{this.state.num_low_stocks}</h3>

                            <p>Number Of Products Running Low</p>
                        </div>
                        <div className="icon">
                            <i className="fas fa-clipboard"></i>
                        </div>
                        <a href="/inventory" className="small-box-footer">More info <i className="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>



                <div className="row">
                    <div className="col-lg-12">
                        <div className="row">
                            <div className="col-lg-6">
                                {/**  barcode input and display of total amount **/} 
                                <div className="row mt-5">
                                    <div className="col-md-12">
                                        <div className="row">
                                            <div className=" col-sm-12 col-md-6">
                                                <input type="text" className="form-control" disabled  value={this.getTotal(this.state.cart)}></input>  
                                            </div>
                
                                            <div className=" col-sm-12 col-md-6">
                                                <form onSubmit={this.handleScanBarcode}>
                                                    <input type="text" className="form-control" 
                                                        placeholder="Scan Barcode..." name="barcode" value={barcode}
                                                        onChange={this.handleBarcode}  autoComplete="off" autoFocus>
                                                    </input>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {/**  list of products added to cart **/} 
                                <div className="row mt-3 user-cart">
                                    <div className=" col-sm-12 col-lg-12">
                                        <div className="card">
                                            <table className="table">
                                                <thead className="thead-dark">
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                {cart.map(c => (
                                                    <tr key={c.id}>
                                                        <td>{c.product_name}</td>
                                                        <td>{c.quantity}</td>
                                                        <td>PHP {c.price * c.quantity}</td>
                                                        <td>
                                                            <span><button className="btn btn-warning mr-1" onClick={()=>this.subtractQuantity(c.id)}><i className="fa fa-minus"></i></button></span>
                                                            <button className="btn btn-success mr-1" onClick={()=>this.addQuantity(c.id)}><i className="fa fa-plus"></i></button>
                                                            <span><button className="btn btn-danger" onClick={()=>this.removeProd(c.id)}><i className="fas fa-window-close"></i> Remove</button></span>
                                                             
                                                        </td>
                                                    </tr>
                                                ))}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                {/**  submit or cancel **/}
                                <div className="row">
                                    <div className="col-sm-12  col-md-6">
                                        <button className="btn btn-danger btn-block" onClick={this.emptyCart}> <i className="fas fa-window-close"></i> Cancel</button>
                                    </div>
                                    <div className="col-sm-12 col-md-6 float-right" >
                                        <button className="btn btn-primary btn-block" onClick={this.handleSubmit}><i className="fa fa-shopping-cart"></i> Confirm</button>
                                    </div>
                                </div>
                            </div>

                            {/** blocks intended for searching products **/} 
                            <div className="col-lg-6 mt-5">
                                <div className="row">
                                    <div className="col-lg-12">
                                        <table id="example1" className="table table-bordered table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Brand Name</th>
                                                    <th>Description</th>
                                                    <th>Unit</th>
                                                    <th>Price</th>
                                                    <th>In Stock</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {products.map(p => (
                                                    <tr key={p.id}>
                                                        
                                                        <td>{p.product_name}</td>
                                                        <td>{p.brand_name}</td>
                                                        <td>{p.description}</td>
                                                        <td>{p.unit}</td>
                                                        <td>{p.price}</td>
                                                        <td>{p.quantity}</td>
                                                        <td>
                                                            <span> <button className="btn btn-success" onClick={()=>this.addToCart(p.barcode)}><i className="fas fa-shopping-cart"></i> Add To Cart</button></span>
                                                        </td>
                                                    </tr>
                                                ))}
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Brand Name</th>
                                                    <th>Description</th>
                                                    <th>Unit</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        )
    }
}
if (document.getElementById("app")) {
    ReactDOM.render(<Cart />, document.getElementById("app"));
}