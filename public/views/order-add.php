<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile home</title>
    <link rel="stylesheet" href="./public/css/main.css" type="text/css">
    <link rel="stylesheet" href="./public/css/home.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="logo" class="column-center-center">
        <img src="./public/img/endeal_logo.svg" alt="endeal logo">
    </div>
    <nav class="row-center-space-around">
        <a href="home.html"><i class="fa-solid fa-house"></i></a>
        <a href="add-order.html"><i class="fa-solid fa-plus"></i></a>
        <a href="product-list.html"><i class="fa-solid fa-list-ul"></i></a>
        <a href="#"><i class="fa-solid fa-gear"></i></a>
    </nav>
    <div id="container">
        <h3>NEW ORDER</h3>
        <form id="form-add-order" action="" class="form-base column-center-stretch">
            <input type="text" name="first-name" placeholder="First name" class="text-input-base">
            <input type="text" name="last-name" placeholder="Last name" class="text-input-base">
            <input type="text" name="city" placeholder="City" class="text-input-base">
            <input type="text" name="street" placeholder="Street" class="text-input-base">
            <input type="text" name="house-number" placeholder="House number" class="text-input-base">
            <input type="text" name="postal-code" placeholder="Postal code" class="text-input-base">
            <select name="product" id="product-select" class="select-base text-input-base">
                <option value="none">---</option>
                <option value="product1">Product 1</option>
                <option value="product2">Product 2</option>
                <option value="product3">Product 3</option>
            </select>
            <input type="text" name="amount" placeholder="Amount" class="text-input-base">
            <input type="text" name="discount" placeholder="Discount" class="text-input-base">
            <button type="submit" class="button-base">ADD</button>
        </form>
    </div>
</body>
</html>