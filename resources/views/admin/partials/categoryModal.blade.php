<div class="modal fade " id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-1">Add New Category</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form action="{{ URL::to('/admin/categories') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">
                                    <sup class="font-weight-bold text-danger">* </sup>Title
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Please Enter Category title..." required>
                            </div>
                        </div>
                          {{-- title arabic  --}}
                          <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="title_ar" class="col-form-label">
                                    <sup class="font-weight-bold text-danger">* </sup> Arabic Title 
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="title_ar" name="title_ar"
                                    placeholder="Please Enter Category title in Arabic..." required>
                            </div>
                        </div>
                        {{-- description --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="description" class="col-form-label">
                                    Description
                                </label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description" rows="5"
                                    cols="30"></textarea>
                            </div>
                        </div>

                        <div class="row mb-4">
                            
                            <div class="col-md-3 ">
                                <label for="categories">
                                    Select Brands
                                </label>
                            </div>

                            <div class="col-md-9">
                                <select class="form-control brands" style="height: auto;" placeholder="Select Brands"
                                    multiple="multiple" name="brands[]" id="">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"> {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- logo_image --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="logoImage" class="col-form-label">Mega Menu Image (500x500) </label>
                            </div>
                            <div class="col-md-9">
                                <input name="logo_image" id="logo_image" type="file">
                            </div>
                        </div>
                        {{-- mobile_image --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="mobileImage" class="col-form-label"> Image (150x150) /png </label>
                            </div>
                            <div class="col-md-9">
                                <input name="mobile_image" id="mobile_image" type="file">
                            </div>
                        </div>
                        {{-- banner_image --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="bannerImage" class="col-form-label">Banner Image (1200 x 225)</label>
                            </div>
                            <div class="col-md-9">
                                <input name="banner_image" id="banner_image" type="file">
                            </div>
                        </div>
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
                        {{-- featured --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="featured" class="col-form-label">Featured</label>
                            </div>
                            <div class="col-md-9">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="featured" id="featured">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
                        </div>

                        {{-- popular --}}
                        <div class="row">
                            <div class="col-md-3">
                                <label for="popular" class="col-form-label">Popular</label>
                            </div>
                            <div class="col-md-9">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="popular" id="popular">
                                    <span class="toggle-switch-slider"></span>
                                </label>
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
