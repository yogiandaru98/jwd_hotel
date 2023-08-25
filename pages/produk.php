<?php $activePage = 'produk'; ?>
<?php include 'header.php' ?>
<div class="container mt-5">

    <div class="d-flex align-content-start d-flex justify-content-between flex-wrap">
        <div class="card m-2" style="width: 300px; height:310px">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 300px; height: 200px;">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img width="300" height="200" src="https://backend.parador-hotels.com/wp-content/uploads/2023/04/Deluxe-Room-Artinya-1024x512.jpg" alt="Gambar 1">
                    </div>
                    <div class="carousel-item">
                        <iframe width="300" height="200" src="https://www.youtube.com/embed/VmAn32gKhF0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="carousel-item">
                        <img width="300" height="200" src="https://www.kokoonhotelsvillas.com/surabaya/wp-content/uploads/sites/2/2020/01/standard-room.jpg" alt="Gambar 2">
                    </div>
                </div>

                <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
            <div class="ml-2">

                <h1>Standar</h1>
                <h3>Rp. 500.000</h3>
            </div>
        </div> 
    </div>
</div>


<?php include 'footer.php' ?>