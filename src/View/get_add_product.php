<form action="/handle_add_product.php" method="POST">
    <div class="container">
        <h1>Добавить товар в корзину</h1>
        <hr>

        <label for="product_id">ID продукта:</label>
        <label style="color: red"><?php if (isset($errors['product_id']))
            {
                echo $errors['product_id'];
            }?></label>
        <input type="text" id="product_id" name="product_id" required>
        <br><br>

        <label for="amount">Количество:</label>
        <label style="color: red"><?php if (isset($errors['amount']))
            {
                echo $errors['amount'];
            }?>
        </label>
        <input type="text" id="amount" name="amount" required>

        <button type="submit" class="registerbtn">Добавить в корзину</button>
</form>
</body>
</html>

<style>
    * {box-sizing: border-box}

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }
    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: palevioletred;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity:1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
</style>