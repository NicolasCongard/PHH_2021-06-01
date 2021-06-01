<nav class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="?page=home">Boutique normande</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="?page=edit&id=1">Editer produit</a></li>
            <li><a href="?page=new">Nouveau produit</a></li>
        </ul>
        <form class="navbar-form navbar-left" action="" role="search" method="GET">
            <div class="form-group">
                <input type="hidden" name="page" value="produits">
                <input type="text" class="form-control" value="<?= isset($_GET["search"]) ? $_GET["search"] : ""; ?>"
                    name="search">
                <div id="completion-container"
                    style="display: none; border:1px solid black; border-top: none; background-color:white; position:fixed; left:44,3%; height:auto; min-height:50px; width:170px;">
                </div>
            </div>
            <button type="submit" class="btn btn-default">Rechercher</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="?page=panier">Panier</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Plus<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="?page=produits&id=all">Tous les produits</a></li>
                    <li><a href="?page=produit&id=1">Favoris</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>