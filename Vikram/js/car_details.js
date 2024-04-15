function addToCart(){
    $('#add_buy_form').attr('action','utils/addToCart.php'); 
    $('#add_buy_form').submit()
}
function Buy(){
    $('#add_buy_form').attr('action','utils/buy.php'); 
    $('#add_buy_form').submit()
}
