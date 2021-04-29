
    <div class="container">
        <div class="row my-4">
            <div class="col">
                <div class="card py-3">
                    <div class="card-body">
                        <h5 class="card-title">Make an Account</h5>
                        <form action="controller.php" method="POST">
                            <input type="hidden" name="page" value="signup">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control mb-3" id="username" name="username" placeholder="Enter your Username" required>

                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control mb-3" id="firstname" name="firstname" placeholder="Enter your first name" required>

                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control mb-3" id="lastname" name="lastname" placeholder="Enter your last name" required>

                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control mb-3" id="email" name="email" placeholder="Enter your email" required>

                            <label for="passwd" class="form-label">Password</label>
                            <input type="text" class="form-control mb-3" id="password" name="password" placeholder="Enter your Password" required>
                            <label for="passwd2" class="form-label">Confirm Password</label>
                            <input type="text" class="form-control mb-3" id="password2" name="password2" placeholder="Confirm your Password" required>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                    </div>
                </div>      
            </div>
        </div>
    </div>
