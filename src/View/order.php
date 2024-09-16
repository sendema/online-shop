<form action="/order" method="POST">
    <div class="container">
        <h1>Оформление заказа</h1>
        <hr>

        <label for="name"><b>Имя:</b></label>
        <label style="color: red"><?php if (isset($errors['name']))
            {
                echo $errors['name'];
            }?></label>
        <input type="text" placeholder="Enter name" name="name" id="name" required>

        <label for="phone"><b>Телефон:</b></label>
        <label style="color: red"><?php if (isset($errors['phone']))
            {
                echo $errors['phone'];
            }?></label>
        <input type="text" placeholder="Enter phone" name="phone" id="phone" required>

        <label for="address"><b>Адрес:</b></label>
        <label style="color: red"><?php if (isset($errors['address']))
            {
                echo $errors['address'];
            }?></label>
        <input type="text" placeholder="Enter address" name="address" id="address" required>

        <label for="comment"><b>Комментарий:</b></label>
        <label style="color: red"><?php if (isset($errors['comment']))
            {
                echo $errors['comment'];
            }?></label>
        <input type="text" placeholder="Enter comment" name="comment" id="comment" required>

        <hr>
        <button type="submit" class="registerbtn">Оформить заказ</button>
    </div>

    <div class="container signin">

    </div>
</form>

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