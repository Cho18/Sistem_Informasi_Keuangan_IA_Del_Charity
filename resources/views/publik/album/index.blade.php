@extends('publik.app')

@section('title', 'Album')

@section('contents')
    <!-- Portfolio Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h2 class="mt-2">Album Dokumentasi</h2>
            </div>
            <div class="row g-4">
                @foreach($gallery as $album)
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="card" >
                        <img src="{{ asset('storage/' . $album->images) }}" height="300px" data-bs-target="#carouselExampleControls" data-bs-toggle="modal" data-bs-target="#carouselExampleControls">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Image Modal Start-->
    <div class="modal fade" id="carouselExampleControls" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($gallery as $index => $album)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $album->images) }}" height="500px" class="card-img-top d-block w-100" alt="...">
                                        <div class="card-body">
                                            <h6>{!! $album->description !!}</h6>
                                            <?php
                                            $bulanIndonesia = [
                                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                            ];
                                            ?>
                                            <small>{{ \DateTime::createFromFormat('Y-m-d', $album->date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $album->date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $album->date)->format(' Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>                        
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Image Modal End -->

    <!-- Pagination Start -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item {{ $gallery->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $gallery->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">Previous</span>
                    </a>
                </li>
                @for($i = 1; $i <= $gallery->lastPage(); $i++)
                    <li class="page-item {{ $i == $gallery->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $gallery->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $gallery->currentPage() == $gallery->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $gallery->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Pagination End -->
@endsection