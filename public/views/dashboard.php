
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/public/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="container">
        <div class="top-bar">
            <div class="logo column-center-center">
                <img src="/public/img/endeal_logo.svg" alt="endeal_logo">
            </div>
            <div class="avatar">

            <i class="fa-solid fa-circle-user"></i>
            <div class="user-menu">
                <div>
                    <a href="/logout">Logout</a>
                </div>
            </div>
            </div>
        </div> 

        <nav>
            <div class="menu-list">
                <div class="menu-section-header">
                    Salesman
                </div>
                <div class="menu-entry">
                    <a href="/register">
                        <i class="fa-solid fa-person-circle-plus"></i>
                        Add
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="/users">
                        <i class="fa-solid fa-person-circle-question"></i>
                        Detail
                    </a>
                </div>
                <div class="menu-section-header">
                    Product
                </div>
                <div class="menu-entry">
                    <a href="/productAdd">
                        <i class="fa-solid fa-plus"></i>
                        Add
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="/products">
                        <i class="fa-solid fa-list"></i>
                        List
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="#">
                        <i class="fa-solid fa-square-poll-vertical"></i>
                        Reports
                    </a>
                </div>
                <div class="menu-section-header">
                    Clients
                </div>
                <div class="menu-entry">
                    <a href="/clientAdd">
                        <i class="fa-solid fa-plus"></i>
                        Add
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="/clients">
                        <i class="fa-solid fa-list"></i>
                        List
                    </a>
                </div>
                <div class="menu-entry">
                    <a href="#">
                        <i class="fa-solid fa-square-poll-vertical"></i>
                        Reports
                    </a>
                </div>
            </div>
        </nav>

        <div class="content column-space-between">
            <div class="content-top">
                <h3>INCOME CHART</h3>
                <div class="graph">
                    graph
                </div>
            </div>
            <div class="content-bottom">
                <div class="badge-left">
                    <h3>BEST SALESMAN</h3>
                    <div class="badge-large">
                        <img src="" alt="badge-large-img">
                        <div class="badge-large-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat elit mauris, ut efficitur velit accumsan ut. Praesent eget viverra neque. Aenean iaculis condimentum venenatis. Integer vel vehicula nibh. Integer elementum lectus sagittis velit gravida, eget pharetra libero fermentum. Sed consequat mauris non turpis iaculis, ut porttitor ipsum ultrices. In vitae ex in ante aliquet semper. 
                        </div>
                    </div>
                </div>
                <div class="badge-right">
                    <h3>BEST PRODUCT</h3>
                    <div class="badge-large">
                        <img src="" alt="badge-large-img">
                        <div class="badge-large-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat elit mauris, ut efficitur velit accumsan ut. Praesent eget viverra neque. Aenean iaculis condimentum venenatis. Integer vel vehicula nibh. Integer elementum lectus sagittis velit gravida, eget pharetra libero fermentum. Sed consequat mauris non turpis iaculis, ut porttitor ipsum ultrices. In vitae ex in ante aliquet semper. 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="column-center-center">
            Copyright &copy; Endeal 2024
        </footer>
    </div>
</body>
</html>