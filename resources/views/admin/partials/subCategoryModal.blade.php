
    <div class="modal fade " id="add-sub" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2">Add Sub Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ URL::to('/admin/subcategories') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                        {{-- title --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">
                                    <sup class="font-weight-bold text-danger">* </sup>Sub Category Title
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

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">
                                    <sup class="font-weight-bold text-danger">* </sup>Category
                                </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control show-tick ms select2"
                                    data-placeholder="Select Main Category" name="category_id" required>
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Brands --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="title" class="col-form-label">
                                    Brands
                                </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control show-tick ms brands" data-placeholder="Select Brands"
                                    style="height: auto ;" name="brands[]" multiple>
                                    <option></option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- attributes --}}
                        <div class="row mb-4 " style="">
                            <div class="col-md-3">
                                <label for="category" class="col-form-label">Attributes</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control select2" style="height: auto;"
                                    placeholder="Select Attributes" multiple="multiple" style="height: auto;"
                                    name="attributes[]" id="">
                                    <option disabled selected value="">Select Attributes</option>
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>
                                    @endforeach

                                </select>
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
                        {{-- image --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="image" class="col-form-label">Image</label>
                            </div>
                            <div class="col-md-9">
                                <input name="image" id="image" multiple type="file">
                            </div>
                        </div>
                        {{-- status --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="status" class="col-form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <label class="toggle-switch">
                                    <input name="status" type="checkbox">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
                        </div>
                        {{-- featured --}}
                        <div class="row">
                            <div class="col-md-3">
                                <label for="featured" class="col-form-label">Featured</label>
                            </div>
                            <div class="col-md-9">
                                <label class="toggle-switch">
                                    <input name="featured" type="checkbox">
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