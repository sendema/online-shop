<main class="main">
    <div class="app app__dark">
        <header class="app-header">
            <img src="https://uploads.turbologo.com/uploads/design/preview_image/321138/preview_image20210819-17584-1a2zumt.png" class="app-logo" alt="logo">
        </header>

        <form class="login" action="/login" method="POST">

            <div class="login-input-group">
                <div class="login-floating-label-form-group login-floating-label-form-group__dark">
                    <label>Имя пользователя</label>
                    <label style="..."><?php if (isset($errors['username']))
                        {
                            echo $errors['username'];
                        }?>
                    </label>
                    <input class="login-form-control login-form-control__dark" type="text" name="username" placeholder="Имя пользователя" />
                    <p class="help-block text-danger"></p>
                </div>

                <div class="login-floating-label-form-group login-floating-label-form-group__dark">
                    <label>Пароль</label>
                    <label style="..."><?php if (isset($errors['password']))
                        {
                            echo $errors['password'];
                        }?>
                    </label>
                    <input class="login-form-control login-form-control__dark" type="password" name="password" placeholder="Пароль" />
                    <p class="help-block text-danger"></p>
                </div>
            </div>

            <div class="login-form-group">
                <button type="submit" class="btn btn__dark btn__xl">Войти</button>
            </div>
        </form>
    </div>
</main>

<style>
:root {
box-sizing: border-box;
}

*,
::before,
::after {
box-sizing: inherit;
}

body {
background-color: white;
color: #212529;
font-family: Lato,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;
margin: 0;
}

p {
margin-top: 0;
margin-bottom: 1rem;
}

.main {
text-align: center;
}

.app {
min-height: 100vh;
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
overflow: hidden;
}

.app__light {
background-color: white;
}

.app__dark {
background-color: white;
}

.app-header {
font-size: calc(10px + 2vmin);
}

.app-logo {
height: 40vmin;
pointer-events: none;
}

@media (prefers-reduced-motion: no-preference) {
.app-logo {
animation: app-logo-shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
}
}

@keyframes app-logo-shake {
10%, 90% {
transform: translate3d(-1px, 0, 0);
}

20%, 80% {
transform: translate3d(2px, 0, 0);
}

30%, 50%, 70% {
transform: translate3d(-4px, 0, 0);
}

40%, 60% {
transform: translate3d(4px, 0, 0);
}
}

.login > * {
width: 50vmin;
min-width: 280px;
}

.login-input-group > * + * {
margin-bottom: 3rem;
}

.login-floating-label-form-group {
position: relative;
border-bottom: 1px solid wheat;
}

.login-floating-label-form-group input {
position: relative;
font-size: 1.5em;
z-index: 1;
padding-right: 0;
padding-left: 0;
resize: none;
border: none;
border-radius: 0;
background: none;
box-shadow: none !important;
}

.login-floating-label-form-group label {
display: block;
position: relative;
top: 2em;
font-size: 0.85em;
line-height: 1.764705882em;
z-index: 0;
margin: 0;
transition: top 0.3s ease, opactite 0.3s ease;
opacity: 0;
text-align: left;
}

.login-floating-label-form-group__light label {
color: black;
}

.login-floating-label-form-group__dark label {
color: #d5cdc4;
}

.login-floating-label-form-group-with-value label {
top: 0;
opacity: 1;
}

.login-floating-label-form-group-with-focus label {
color: #d4af37;
}

.login-form-control {
display: block;
width: 100%;
height: calc(1.5em + 1rem);
padding: 0.375rem 0.75rem;
font-weight: 400;
line-height: 1.5;
}

.login-form-control__light {
color: black;
}

.login-form-control__dark {
color: #d5cdc4;
}

.login-form-control:focus {
background: none;
outline: 0;
}

.login-form-control__light:focus {
color: black;
}

.login-form-control__dark:focus {
color: #d5cdc4;
}

.btn {
background-color: transparent;
cursor: pointer;
}

.btn:focus {
outline: none;
}

.btn__light {
color: black;
border: 1px solid black;
}

.btn__light:focus,
.btn__light:hover
{
color: white;
background-color: black;
}

.btn__dark {
color: #d5cdc4;
border: 1px solid wheat;
}

.btn__dark:focus,
.btn__dark:hover
{
color: #282c34;
background-color: wheat;
}

.btn__xl {
width: 280px;
height: 64px;
font-family: Montserrat,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;
font-size: 18px;
font-weight: 400;
text-transform: uppercase;
border-radius: 32px;
}
</style>
