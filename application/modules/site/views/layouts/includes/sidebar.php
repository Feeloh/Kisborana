

  <nav class="col-md-2 d-none d-md-block bg-light sidebar mt-50">
  <div class="sidebar-sticky" >
    <ul class="nav flex-column"> 
      
       
    <li class="nav-item">
        <a class="nav-link" href="#" >
          <!-- <span data-feather="file"></span> -->
          <div align="center"><?php echo anchor("member/member","MEMBERS", array("class"=> "text-dark"));?> <span class="sr-only">(current)</span>
        </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">
          <!-- <span data-feather="home"></span> -->
          <div align="center">
          <a class="text-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            SAVINGS
          </a>
          </div>

          <div align = "right" class="collapse" id="collapseExample"><?php echo anchor("saving_type/index","Saving Types", array("class"=> "text-dark", ));?> <span class="sr-only">(current)</span>
          </div>

          <div align = "right" class="collapse" id="collapseExample"><?php echo anchor(" ","Members Savings", array("class"=> "text-dark", ));?> <span class="sr-only">(current)</span>
          </div>

        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <!-- <span data-feather="file"></span> -->
          <div align="center"><?php echo anchor("loan_types/loan_types","LOAN TYPES", array("class"=> "text-dark"));?> <span class="sr-only">(current)</span>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <!-- <span data-feather="file"></span> -->
          <div align="center"><?php echo anchor("loans/loans","LOAN", array("class"=> "text-dark"));?> <span class="sr-only">(current)</span>
          </div>
        </a>
      </li>
         
  </ul>
  </div>
</nav>

