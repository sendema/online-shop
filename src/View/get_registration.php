<form action="/registrate" method="POST">
    <div class="container">
        <h1>Регистрация</h1>
        <p>Заполните эту форму, чтобы создать учетную запись.</p>
        <hr>

        <label for="name"><b>Name</b></label>
        <label style="color: red"><?php if (isset($errors['name']))
        {
            echo $errors['name'];
        }?></label>
        <input type="text" placeholder="Enter name" name="name" id="name" required>

        <label for="email"><b>Email</b></label>
        <label style="color: red"><?php if (isset($errors['email']))
        {
            echo $errors['email'];
        }?></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="psw"><b>Password</b></label>
        <label style="color: red"><?php if (isset($errors['psw']))
        {
            echo $errors['psw'];
        }?></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <label style="color: red"><?php if (isset($errors['psw-repeat']))
        {
            echo $errors['psw-repeat'];
        }?></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
        <hr>
        <p>Создавая учетную запись, вы соглашаетесь с нашими <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn">Зарегистрироваться</button>
    </div>

    <div class="container signin">
        <p>Уже зарегистрированы? <a href="/login">Войти</a>.</p>
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
    background-color: #333;
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