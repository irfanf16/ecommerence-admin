<div class="modal fade" id="add-key" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-3"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-3">Add New Keys</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ URL::to('/admin/attributes') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="Title" class="col-form-label">
                                <sup class="font-weight-bold text-danger">* </sup>Name
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                     {{-- arabic title  --}}
                     <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="name_ar" class="col-form-label">
                                <sup class="font-weight-bold text-danger">* </sup>Arabic Name
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="name_ar" name="name_ar" required>
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
                    {{-- Attributes --}}
                    <div class="row mb-4 subcat-block" style="">
                        <div class="col-md-3">
                            <label for="category" class="col-form-label"> Attributes </label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control select2" style="height: auto;" placeholder="Select SubCategory"
                                multiple="multiple" required name="attributes[]" id="">
                                <option disabled selected value="">Select attributes</option>
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>
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