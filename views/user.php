<?php require_once dirname(__DIR__, 1) . '/views/layout/header.php'; ?>

<div class = "container">
    <h2><?= $title ?></h2>

    <div class="card m-5" >
        <div class="card-body">
            <h5 class="card-title"><?= $user->name ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= $user->email ?></h6>
            <p class="card-text"><?= $user->address ?></p>
            <a href="/" class="card-link">Зарегистрировать еще</a>            
        </div>
    </div>


</div>

<?php
require_once dirname(__DIR__, 1) . '/views/layout/footer.php';



