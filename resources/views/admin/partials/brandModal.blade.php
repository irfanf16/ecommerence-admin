
    <div class="modal fade " id="add-brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-1">Add New Brand</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ URL::to('/admin/brands') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="col-md-6 mx-auto">

                        <div class="row">
                            {{-- choose category --}}
                            {{-- <div class="col-md-6 mb-4">
                                <label for="fullname">
                                    <strong>Select Category: <sup class="text-danger">*</sup></strong>
                                </label>
                                <select class="form-control show-tick ms select2" name="category_id" id="user_id" required>
                                    <option disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            {{-- brand name --}}
                            <div class="col-md-12 mb-4">
                                <label for="fullname">
                                    <strong>Brand Name: <sup class="text-danger">*</sup></strong>
                                </label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                                {{-- arabic name  --}}
                                <div class="col-md-12 mb-4">
                                    <label for="name_ar">
                                        <strong>Arabic Name: <sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="text" class="form-control" name="name_ar" id="name_ar" required>
                                </div>
                            {{-- brand description --}}
                            <div class="col-md-12 mb-4">
                                <label for="fullname">
                                    <strong>Brand Description:</strong>
                                </label>
                                <textarea class="form-control" name="description" id="description" rows="8"></textarea>
                            </div>


                            {{-- categories --}}
                            <div class="col-md-12 mb-4">
                                <label for="categories">
                                    <strong> Select Category </strong>
                                </label>
                                <select class="form-control categories" style="height: auto;"
                                    placeholder="Select Categories" multiple="multiple" name="categories[]" id="">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->title }} </option>

                                    @endforeach
                                </select>
                            </div>

                            {{-- Sub categories --}}
                            <div class="col-md-12 mb-4">
                                <label for="subcategories">
                                    <strong> Select SubCategory </strong>
                                </label>
                                <select class="form-control subcategories" style="height: auto;"
                                    placeholder="Select SubCategories" multiple="multiple" name="subcategories[]" id="">
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}"> {{ $subcategory->title }} </option>

                                    @endforeach
                                </select>
                            </div>

                            {{-- Child categories --}}
                            <div class="col-md-12 mb-4">
                                <label for="categories">
                                    <strong> Select ChildCategory </strong>
                                </label>
                                <select class="form-control childcategories" style="height: auto;"
                                    placeholder="Select ChildCategories" multiple="multiple" name="childcategories[]" id="">
                                    @foreach ($childcategories as $childcategory)
                                        <option value="{{ $childcategory->id }}"> {{ $childcategory->title }} </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            {{-- logo Image --}}
                            <div class="col-md-12 mb-4">
                                <label for="profile_image">
                                    <strong>Logo Image:</strong>
                                </label>
                                <input type="file" class="form-control" id="logo_image" name="logo_image">
                            </div>

                            {{-- Cover Image --}}
                            <div class="col-md-12 mb-4">
                                <label for="profile_image">
                                    <strong>Cover Image:</strong>
                                </label>
                                <input type="file" class="form-control" id="cover_image" name="cover_image">
                            </div>

                            {{-- featured --}}
                            <div class="col-md-4 my-4">
                                <label class="d-block">
                                    <strong>Featured:</strong>
                                </label>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="featured" id="featured">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>

                            {{-- status --}}
                            <div class="col-md-4 my-4">
                                <label class="d-block">
                                    <strong>Status:</strong>
                                </label>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="status" id="status">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
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