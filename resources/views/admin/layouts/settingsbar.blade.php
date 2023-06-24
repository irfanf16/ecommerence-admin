{{-- right sidebar for theme settings featrues --}}
<div class="right_sidebar">
    <div class="setting_div">
        <a href="javascript:void(0);" class="rightbar_btn"><i class="fa fa-cog fa-spin"></i></a>
    </div>
    <ul class="nav nav-pills nav-fill flex-column flex-sm-row mx-3 my-3" id="myTab" role="tablist">
        <li class="nav-item"><a class="nav-link active" id="Settings-tab" data-toggle="tab" href="#Settings" role="tab"
                aria-controls="Settings" aria-selected="true">Settings</a></li>
        <li class="nav-item"><a class="nav-link" id="Contact-tab" data-toggle="tab" href="#Contact" role="tab"
                aria-controls="Contact" aria-selected="false">Contact</a></li>
    </ul>
    <hr>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane show active" id="Settings" role="tabpanel" aria-labelledby="Settings-tab">
            <div class="sidebar-scroll">
                <div class="sidebar-widget px-3">
                    <h5>Theme Setting</h5>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="black">
                            <div class="black"></div>
                        </li>
                        <li data-theme="azure">
                            <div class="azure"></div>
                        </li>
                        <li data-theme="indigo" class="active">
                            <div class="indigo"></div>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>
                        </li>
                    </ul>
                    <ul class="setting-list list-unstyled mt-3">
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Dark Sidebar</span>
                                <label class="toggle-switch switch-sm mb-0">
                                    <input type="checkbox" class="switch-dark">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Mini Sidebar</span>
                                <label class="toggle-switch switch-sm mb-0">
                                    <input type="checkbox" class="switch-sidebar">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>
                <div class="sidebar-widget px-3">
                    <h5>Language Setting</h5>
                    <select class="selectpicker" title="Select language">
                        <option>English</option>
                        <option>Spanish</option>
                        <option>Chinese</option>
                        <option>Hindi</option>
                        <option>Arabic</option>
                    </select>
                    <hr>
                </div>
                <div class="sidebar-widget px-3">
                    <h5>General Setting</h5>
                    <ul class="setting-list list-unstyled mt-3">
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Report Panel Usage</span>
                                <label class="toggle-switch switch-sm mb-0">
                                    <input type="checkbox" checked>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Email Redirect</span>
                                <label class="toggle-switch switch-sm mb-0">
                                    <input type="checkbox" checked>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Notifications</span>
                                <label class="toggle-switch switch-sm mb-0">
                                    <input type="checkbox">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Location Permission</span>
                                <label class="toggle-switch switch-sm mb-0">
                                    <input type="checkbox" checked>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>
                <div class="sidebar-widget px-3">
                    <div class="progress-wrapper">
                        <h4 class="progress-label text-uppercase">New Project</h4>
                        <h4 class="progress-percentage text-uppercase">$950</h4>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                aria-valuemax="100" style="width: 40%;"></div>
                        </div>
                    </div>
                    <div class="progress-wrapper">
                        <h4 class="progress-label text-uppercase"> Admin</h4>
                        <h4 class="progress-percentage text-uppercase">$10k</h4>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="78" aria-valuemin="0"
                                aria-valuemax="100" style="width: 78%;"></div>
                        </div>
                    </div>
                    <div class="progress-wrapper">
                        <h4 class="progress-label text-uppercase">Balance</h4>
                        <h4 class="progress-percentage text-uppercase">$50k</h4>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="55" aria-valuemin="0"
                                aria-valuemax="100" style="width: 55%;"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="progress-wrapper">
                        <h4 class="progress-label text-uppercase">Storage</h4>
                        <h4 class="progress-percentage text-uppercase">35GB</h4>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-red" role="progressbar" aria-valuenow="89" aria-valuemin="0"
                                aria-valuemax="100" style="width: 89%;"></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-block btn-animated btn-animated-x">
                        <span class="btn-inner--visible">Upgrade Now</span>
                        <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="Contact" role="tabpanel" aria-labelledby="Contact-tab">
            <div class="sidebar-widget px-3">
                <ul class="list-unstyled contact-list">
                    <li class="d-flex align-items-center">
                        <span class="contact-img">
                            <img src="{{ URL::to('/assets/images/xs/avatar1.jpg') }}" class="rounded" alt="">
                        </span>
                        <h4 class="contact-name">Vincent Porter <span class="d-block">London UK</span></h4>
                        <div class="action">
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fab fa-skype"></i></a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fa fa-envelope"></i></a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="contact-img">
                            <img src="{{ URL::to('/assets/images/xs/avatar2.jpg') }}" class="rounded" alt="">
                        </span>
                        <h4 class="contact-name">Mike Thomas <span class="d-block">London UK</span></h4>
                        <div class="action">
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fab fa-skype"></i></a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fa fa-envelope"></i></a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="contact-img">
                            <img src="{{ URL::to('/assets/images/xs/avatar3.jpg') }}" class="rounded" alt="">
                        </span>
                        <h4 class="contact-name">Aiden Chavaz</h4>
                        <div class="action">
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fab fa-skype"></i></a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fa fa-envelope"></i></a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="contact-img">
                            <img src="{{ URL::to('/assets/images/xs/avatar4.jpg') }}" class="rounded" alt="">
                        </span>
                        <h4 class="contact-name">Vincent Porter <span class="d-block">Miami USA</span></h4>
                        <div class="action">
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fab fa-skype"></i></a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fa fa-envelope"></i></a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="contact-img">
                            <img src="{{ URL::to('/assets/images/xs/avatar5.jpg') }}" class="rounded" alt="">
                        </span>
                        <h4 class="contact-name">Mike Thomas <span class="d-block">Neyyork USA</span></h4>
                        <div class="action">
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fab fa-skype"></i></a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fa fa-envelope"></i></a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="contact-img">
                            <img src="{{ URL::to('/assets/images/xs/avatar6.jpg') }}" class="rounded" alt="">
                        </span>
                        <h4 class="contact-name">Aiden Chavaz</h4>
                        <div class="action">
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fab fa-skype"></i></a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fa fa-envelope"></i></a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="contact-img">
                            <img src="{{ URL::to('/assets/images/xs/avatar7.jpg') }}" class="rounded" alt="">
                        </span>
                        <h4 class="contact-name">Mike Thomas <span class="d-block">New Delhi IND</span></h4>
                        <div class="action">
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fab fa-skype"></i></a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fa fa-envelope"></i></a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="contact-img">
                            <img src="{{ URL::to('/assets/images/xs/avatar8.jpg') }}" class="rounded" alt="">
                        </span>
                        <h4 class="contact-name">Aiden Chavaz</h4>
                        <div class="action">
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fab fa-skype"></i></a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i
                                    class="fa fa-envelope"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
