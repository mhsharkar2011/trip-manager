<form method="GET" action="{{ route('admin.trips.index') }}" class="row gy-2 gx-3 align-items-center">
    <div class="col-auto">
      <div class="input-group">
        <input type="search"  name="search" id="autoSizingInputGroup" class="form-control" placeholder="Search">
      </div>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i></button>
    </div>
  </form>