<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/landing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Student Social Media</title>
</head>
<body>
    <div class="wrap">

        <!-- Navbar -->
        <?php $title = "Welcome"?>
        
        <?php include("src/components/header.php") ?>
        
        <!-- Main -->
        <div class="main_wrap">
            <div class = "landing_pic">
                <figcaption id="cap">Review, teach, learn, and connect with your fellow peers. Enhnace your school experience.</figcaption>
            </div>
            <div>
                <div class="landTitle">
                    How to Best Use SchoolBoard
                </div>
                <div class="card">
                    <div class="text-box">
                        <p class="text-title">Clear Your Confusions</p>
                        <p class="paragraph">There are no bad questions. Ask questions,
                        get answers, and expand your learning!
                        </p>
                    </div>
                </div>
                <br>
                <div class="right-card">
                    <div class="text-box">
                        <p class="text-title">Teach To Learn</p>
                        <p class="paragraph">Respond with your best answer! You may be wrong,
                        but you will be better. Enhance your understanding.
                        </p>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="text-box">
                        <p class="text-title">Practice Makes Perfect</p>
                        <p class="paragraph">Get access to tons of practice problems posted by
                        fellow students in your program. Feel the joy of being
                        better every day.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    
        <?php include("src/components/footer.php") ?>
    </div>
    <script src="./src/js/app.js"></script>
</body>
</html>