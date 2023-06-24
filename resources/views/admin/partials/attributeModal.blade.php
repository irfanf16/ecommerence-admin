<div class="modal fade" id="add-attrib" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-3"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-3">Add New Attribute</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ URL::to('/admin/attributes') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                        {{-- title --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="Title" class="col-form-label">
                                    <sup class="font-weight-bold text-danger">* </sup>Title
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        {{-- arabic title  --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="title_ar" class="col-form-label">
                                    <sup class="font-weight-bold text-danger">* </sup>Arabic Title
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                            </div>
                        </div>
                        {{-- description --}}
                        {{-- <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="description" class="col-form-label">
                                    Description
                                </label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description" rows="5"
                                    cols="30"></textarea>
                            </div>
                        </div> --}}
                        {{-- status --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="status" class="col-form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="status" id="status">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
                        </div>

                        {{-- Category --}}
                        {{-- <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="category" class="col-form-label">Category</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control select2" placeholder="Select Category" required
                                    name="category" id="">
                                    <option disabled selected value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}


                        {{-- Sub Category --}}
                        <div class="row mb-4 subcat-block" style="">
                            <div class="col-md-3">
                                <label for="category" class="col-form-label">SubCategory</label>
                            </div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-sub"> Add New
                                </button> 
                                <select class="form-control select2" style="height: auto;"
                                    placeholder="Select SubCategory" multiple="multiple" name="subcategories[]" id="">
                                    <option disabled selected value="">Select SubCategory</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        {{-- Child Category --}}
                        <div class="row mb-4 subcat-block" style="">
                            <div class="col-md-3">
                                <label for="category" class="col-form-label">ChildCategory</label>
                            </div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-child"> Add New
                                </button> 
                                <select class="form-control select2" style="height: auto;"
                                    placeholder="Select ChildCategory" multiple="multiple" name="childcategories[]"
                                    id="">
                                    <option disabled selected value="">Select ChildCategory</option>
                                    @foreach ($childcategories as $childcategory)
                                        <option value="{{ $childcategory->id }}">{{ $childcategory->title }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="row mb-4 subcat-block" style="">
                            <div class="col-md-3">
                                <label for="category" class="col-form-label">Keys</label>
                            </div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-key"> Add New
                                </button>
                                <select class="form-control select2" style="height: auto;" placeholder="Select Keys "
                                    multiple="multiple" name="keys[]" id="">


                                    @foreach ($keys as $key)

                                        <option value="{{ $key->id }}">{{ $key->name }}
                                        </option>


                                    @endforeach

                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary ml-2" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>