<header>
<<<<<<< HEAD
    <div class="header">
        <img id="logo" src="images/Logo.png" alt="Site Logo">
        
        <?php if (isset($_SESSION['email'])) : ?>
            <a href="#" class="icon3"><i id="cartIcon" class="fas fa-shopping-cart"></i></a>
            <a href="#" class="icon2" onclick="toggleSidebar()"><i class="fas fa-user"></i></a>
            <a href="logout.php" class="icon"><i class="fas fa-sign-out-alt"></i></a>
        <?php else : ?>
            <a href="#" class="icon2" onclick="toggleSidebar2()"><i class="fas fa-shopping-cart"></i></a>
            <a href="login.php" class="icon"><i class="fas fa-user"></i></a>
        <?php endif; ?>
    </div>
</header>
=======
        <div class="header">
            <img id="logo" src="images/Logo.png" alt="Site Logo">
            
            <?php if (isset($_SESSION['email'])) : ?>
                <a href="verCarrinho.php" class="icon3"><i class="fas fa-shopping-cart"></i></a>
                <a href="#" class="icon2" onclick="toggleSidebar()"><i class="fas fa-user"></i></a>
                <a href="logout.php" class="icon"><i class="fas fa-sign-out-alt"></i></a>
            <?php else : ?>
                <a href="verCarrinho.php" class="icon2"><i class="fas fa-shopping-cart"></i></a>
                <a href="login.php" class="icon"><i class="fas fa-user"></i></a>
                
            <?php endif; ?>
        </div>
    </header>
>>>>>>> ed697891fd5aa89578363c592c731786af1ed493
