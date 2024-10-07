<div class="container">
    <img src="https://i.imgur.com/qIufhof.png" />

    <h1>
        <span>500</span> <br />
        Internal server error
    </h1>
    <p>В настоящее время мы пытаемся решить проблему!</p>
    <p class="info">
        <a href="https://www.kapwing.com/404-illustrations" target="_blank"></a
    </p>
</div>

<style>
    @import url("https://fonts.googleapis.com/css?family=Fira+Code&display=swap");

    * {
        margin: 0;
        padding: 0;
        font-family: "Fira Code", monospace;
    }
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #ecf0f1;
    }

    .container {
        text-align: center;
        margin: auto;
        padding: 4em;
        img {
            width: 256px;
            height: 225px;
        }

        h1 {
            margin-top: 1rem;
            font-size: 35px;
            text-align: center;

            span {
                font-size: 60px;
            }
        }
        p {
            margin-top: 1rem;
        }

        p.info {
            margin-top: 4em;
            font-size: 12px;

            a {
                text-decoration: none;
                color: rgb(84, 84, 206);
            }
        }
    }
</style>