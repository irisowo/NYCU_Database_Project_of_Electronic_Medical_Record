<!DOCTYPE html>
<?php
    include 'header.php';
?>

  <body id="SearchPage">
    <div class="" id="home">
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
          <a class="navbar-brand" href="index.php">
            <h1 class="tm-site-title mb-0">共 病 關 係 分 析 平 台</h1>
          </a>
          <button
            class="navbar-toggler ml-auto mr-0"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars tm-nav-icon"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-3 h-100">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <i class="far fa-user"></i> Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="list.php">
                  <i class="far fa-user"></i> List
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>
      <!-- Input box-->
      <div class="container mt-5">
        <div class="row tm-content-row">
          <div class="col-12 tm-block-col">
            <!--block1-->
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <h2 class="tm-block-title">Search for the nearest k neighbors</h2>
              <form method="post" action="search_result.php" class="tm-signup-form row">
                <div class="form-group col-12">
                  <label for="name">Input ICD9 in format xxx.x or xxx <a href="list.php">(Click here to check for valid icd9)</a> </label>
                  <input id="name" name="name" type="text" class="form-control validate" required pattern=[0-9][0-9][0-9].[0-9]|[0-9][0-9][0-9] oninvalid="this.setCustomValidity('input form : xxx.x or xxx')" oninput="this.setCustomValidity('')"><br>
                  
                  <label for="name">Input the number of neighbors ranging from 1 to 100</label>
                  <input id="neighbor_num" name="neighbor_num" type="number" class="form-control validate" required pattern=[0-9][0-9][0-9] min="1" max="100" oninvalid="this.setCustomValidity('range : 1~100')" oninput="this.setCustomValidity('')" ><br>
                  
                  <div class="tm-block-h-auto">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase">
                      Submit
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!--end of block1-->
            <div class="container mt-5"></div>
            <!-- block2-->
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <h2 class="tm-block-title">Search for the neighbors based on level</h2>
              <form method="post" action="search_result.php" class="tm-signup-form row">
                <div class="form-group col-12">
                  <label for="name">Input ICD9</label>
                  <input id="name" name="name" type="text" class="form-control validate" required pattern=[0-9][0-9][0-9].[0-9]|[0-9][0-9][0-9] oninvalid="this.setCustomValidity('input form : xxx.x')" oninput="this.setCustomValidity('')"><br>
                  <Select name="type" class="form-control validate" required>
                    <option value="">Choose the level</option><option value="1">Level 1</option><option value="2">Level 2</option><option value="3">Level 3</option>
                    <option value="4">Level 4</option><option value="5">Level 5</option>
                  </Select>
                  <br>
                  <div class="tm-block-h-auto">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase">
                      Submit
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!-- end_block2-->
            <div class="container mt-5"></div>
            <!-- block3
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <h2 class="tm-block-title">Picture </h2>
              <form action="index.php" method="post" class="tm-signup-form row">
                <div class="form-group col-lg-6">
                  <label for="name1">Input the first icd9</label>
                  <input id="name1" name="name1" type="text" class="form-control validate"/>
                </div>

                <div class="form-group col-lg-6">
                  <label for="name2">Input the second icd9</label>
                  <input id="name2" name="name2" type="text" class="form-control validate"/>
                  <br>
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block text-uppercase">
                    Submit
                  </button>
                  </div>
              </form>
            </div> 
            end_block3-->
          </div>
        </div>
      </div> 
      <!-- Input box-->

      <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
          <p class="text-center text-white mb-0 px-4 small">
           &copy 僅 供 demo 使 用 ， 無 商 用
          </p>
        </div>
      </footer>

    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>

