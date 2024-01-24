<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="views/scss/css/Login.css"> -->
    <link rel="stylesheet" href="views/scss/css/login.css">
    <script src="views/js/Login.js"></script>
</head>
<body>
        <div id="container">
            <div class="form-container sign-up-container">
                <form action="index.php?page=User&action=processRegistration" method="POST">
                    <h1>Urban Store</h1>
                    <h2>Sign Up</h2>
                    <label>
                        <input type="text" name="registerUsername" placeholder="Name">
                    </label>
                    <label>
                        <input type="text" name="registerSurnames" placeholder="Surname">
                    </label>
                    <label>
                        <input type="email" name="registerEmail" placeholder="Email">
                    </label>
                    <label>
                        <input type="password" name="registerPassword" placeholder="Password">
                    </label>
                    <span><div></div>or<div></div></span>
                    <div class="social-container">
                        <a href="mailto:d.duque.dev@gmail.com" target="_blank" class="social">
                            <div class="button-expand">
                                <img src="views/assets/images/utils/google.png" alt="Google">
                                <p>Sign in with Google</p>
                            </div>
                        </a>
                    </div>
                    <button style="margin-top: 9px">Sign Up</button>
                    <?php if ($incorrectPassword) {
                        echo "Incorrect password";
                    } ?>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <?php 
                if(!isset($_POST["function"])){
                    echo "<form action='index.php?page=User&action=processLogin' method='POST'>";
                } else {
                    echo "<form action='index.php?page=User&action=processLogin&code=".$_GET['code']."' method='POST'>";
                }
                ?>
                    <h1>Urban Store</h1>
                    <h2>Sign In</h2>
                    <label>
                        <input type="email" name="loginEmail" placeholder="Email">
                    </label>
                    <label>
                        <input type="password" name="loginPassword" placeholder="Password">
                    </label>
                    <a href="#">Forgot your password?</a>
                    <span><div></div>or<div></div></span>
                    <div class="social-container">
                        <a href="mailto:d.duque.dev@gmail.com" target="_blank" class="social">
                            <div class="button-expand">
                                <img src="views/assets/images/utils/google.png" alt="Google">
                                <p>Sign in with Google</p>
                            </div>
                        </a>
                    </div>
                    <button>Sign In</button>
                    <p><?php if ($incorrectPassword) {
                        echo "Incorrect password";
                    } ?></p>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Log in</h1>
                        <p>Sign in here if you already have an account</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Create an Account!</h1>
                        <p>Sign up if you still don't have an account</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>