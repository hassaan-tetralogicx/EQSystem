@extends('layouts.dashboard')

@section('content')
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-split nk-split-page nk-split-md ">
                    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container w-lg-45  bg-primary">
                        {{-- <div class="absolute-top-right d-lg-none p-5">
                            <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info">vcxzaadvsf</em></a>
                        </div> --}}
                        <div class="nk-block nk-block-middle nk-auth-body">
                            {{-- <div class="brand-logo pb-5">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div> --}}
                            <div class="nk-block-head text-center">
                                <div class="nk-block-head-content ">
                                    <h3 class="text-white nk-block-title">Exam finished!</h3>
                                    @if ($result->grade == 'F')
                                        <div class="nk-block-des">
                                            <p class="text-white">Unfortunately you didn't make it. Good Luck for the next time.</p>
                                        </div>
                                    @else
                                        <div class="nk-block-des">
                                            <p class="text-white">Congratulations, You have passed the exam.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div><!-- .nk-block -->
                    </div><!-- .nk-split-content -->
                    <div class="nk-split-content nk-split-stretch bg-light d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                        <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                            <div class="nk-feature nk-feature-center">
                                <div class="nk-feature-content ">
                                    @if ($result->grade == 'F')
                                        <h1 class="text-danger display-2">FAIL !</h1>
                                    @elseif($result->grade == 'D' || $result->grade == 'C' || $result->grade == 'B' || $result->grade == 'A')
                                        <h1 class="text-success display-2">PASS !</h1>
                                    @endif
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="profile-ud wider" >
                                                        <span class="profile-ud-label" style="width: 200px;">Total Questions</span>
                                                        <span class="profile-ud-value">{{ $result->correct_answer + $result->wrong_answer }}</span>
                                                    </div>
                                                    {{-- <div class="profile-ud wider">
                                                        <span class="profile-ud-label"  style="width: 200px;">Correct Answers</span>
                                                        <span class="profile-ud-value">{{ $result->correct_answer }}</span>
                                                    </div> --}}
                                                    <div class="profile-ud wider" >
                                                        <span class="profile-ud-label"  style="width: 200px;">Total Exam Marks</span>
                                                        <span class="profile-ud-value">{{ $result->exam->total_exam_marks }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-5">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label"  style="width: 200px;">Grade</span>
                                                        <span class="profile-ud-value">{{ $result->grade }}</span>
                                                    </div>

                                                    {{-- <div class="profile-ud wider">
                                                        <span class="profile-ud-label"  style="width: 200px;">Wrong Answers</span>
                                                        <span class="profile-ud-value">{{ $result->wrong_answer }}</span>
                                                    </div> --}}
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label" style="width: 200px;">Total Obtained Marks</span>
                                                        <span class="profile-ud-value">{{ $result->obtained_exam_marks }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .nk-feature -->
                        </div><!-- .slider-wrap -->
                    </div><!-- .nk-split-content -->
                </div><!-- .nk-split -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>


@endsection


