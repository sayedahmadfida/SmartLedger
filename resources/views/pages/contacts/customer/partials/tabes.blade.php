<ul class="nav nav-tabs">
  <li class="___class_+?17___ active"><a href="#tab_4"  onclick="removeBtns()" data-toggle="tab" aria-expanded="false">Account</a></li>
  
  <li class="dropdown pull-right">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          More
          <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
          <li>
            <a role="menuitem" tabindex="-1" href="#" onclick="setModelId(event)"
                data-id=" {{Crypt::encrypt( $customer->id ) }}"  data-toggle="modal" data-target="#transaction-model"p> <i class="fa-regular fa-money-bill-1 text-info"></i>Transaction
            </a>
        </li>
          <li role="presentation">
              <a href="javascript:void(0)" onclick="clearAccount(event)"> <i class="fa-solid fa-brush"></i> Clear
                  Account</a>
          </li>
      </ul>
  </li>
</ul>