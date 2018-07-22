@extends('admin.input.tambah.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
       @if(session()->has('add'))
      <div class="row">
        <div class="alert alert-info">
          <strong>{{ session()->get('add')}}</strong>
        </div>
      </div>
      @endif

<div class="box-header">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="http://demo.expertphp.in/js/jquery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/rincian.css') }}">
    <link rel="stylesheet" href="{{ asset('css/input.css') }}">
</head>

<form method="POST" id="myForm" name="vform" onsubmit="return Validate()" action="{{ route('tambah.store') }}" enctype="multipart/form-data">
{{ csrf_field() }}

        <h2><b><center>Rincian Biaya</center></b></h2>
        <hr style="border-width: 2px; border-color: black;"></hr>

            <div id="event">
              <div class="pejabat">
              <h4>Nama Pegawai</h4>
              <select name="nama" id="pegawai" class="livesearch" style="width: 180px;" required>
              <option></option>
                   @foreach ($pegawai as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
              </select>
              </div>

              <div class="pejabat">
                <div id="nip_pegawai" class="pjt"></div>
              </div>
              <div class="pejabat">
                <div id="pangkat" class="pjt"></div>
              </div>
              <div class="pejabat">
                <div id="jabatan" class="pjt"></div>
              </div>
              <div class="pejabat">
                <div id="tingkat" class="pjt"></div>
              </div>
              </center>
            </div>

              <select hidden id="nama" name="pejabat" required>
              <input hidden id="nips" name="nip_pejabat" value="{{$id->nip_pejabat}}" required></input>
              <select hidden  id="bendahara" name="bendahara" required></select>
              <select hidden id="nip_bendahara" name="nip_bendahara" required></select>
              <input hidden value="PESERTA" size="35" name="posisi" required></input> 

            <div class="event">
              <div class="mbt">
                  <input hidden name="maksud" type="text area" value="{{ $id->maksud }}" placeholder="Maksud Perjalanan Dinas" size="36" required></input>
              </div>

              <div class="mbt">
                  <input hidden size="35" value="Kota Administrasi Jakarta Pusat" name="berangkat"></input>
              </div>

              <!-- Tujuan -->
              <div class="mbt">
                  <select hidden name="tujuan" id="tujuan" required>
                  <option hidden value="{{ $id->tujuan }}"></option>
                </select>
              </div>
            </div>

            <div class="event">
              <div id="angkutan" class="transportasi">
              
              </div>

              <div class="transportasi">
                <input hidden value="{{$id->tanggal_berangkat}}" hidden type="date" name="tanggal_berangkat" required></input>
              </div>

              <div class="transportasi">
                <input hidden type="date" name="tanggal_kembali" value="{{$id->tanggal_berangkat}}" hidden required></input>
              </div>

              <div class="transportasi">
                <input hidden required type="number" min="0" name="lama" value="{{$id->lama}}"></input>
                <input value="{{$id->transportasi}}" id="trans" hidden name="transportasi" required></input>
              </div>
            </div>

            <div class="event">
              <div class="coba">
              <select hidden id="angkut" name="keluaran" style="width: 200px;" required>
                  <option hidden value="{{$id->keluaran}}"></option>
                </select>
              </div>

              <div class="coba">
              <select hidden id="angkut" name="komponen" style="width: 200px;" required>
                  <option hidden value="{{$id->komponen}}"></option>
                </select>
              </div>

              <div class="coba">
              <select hidden id="angkut" name="sub" style="width: 200px;" required>
                  <option hidden value="{{$id->sub}}"></option>
                </select>
              </div>

              <div class="coba">
              <select hidden id="angkut" name="akun" required>
                <option hidden value="{{$id->akun}}"></option>
              </select>
              </div>
            </div>

               @if ($id->transportasi != 'Angkutan Darat')
                <div id="TPK" class="form-group">
                  <input hidden value="{{$id->h_ku}}" name="h_ku"></input><input hidden value="{{$id->h_ku}}" name="t_ku"></input>
                  <label>Pesawast / KA</label><input style="width:130px;" required type="text" name="n_transport" placeholder="Nama Pesawat / KA" class="form-control"></input><input style="width:130px;" required type="text" name="no_berangkat" placeholder="No Tiket Berangkat" class="form-control"></input><input style="width:120px;" required id="tkt-ht" min="0" placeholder="Harga Tiket Berangkat" type="number" name="h_tiket" class="form-control"></input><input style="width:130px;" required type="text" name="nk_transport" placeholder="Nama Pesawat / KA" class="form-control"></input><input style="width:130px;" type="text" required name="no_kembali" placeholder="No Tiket Pulang"  class="form-control"></input><input style="width:120px;" id="tkt-htp" required min="0" placeholder="Harga Tiket Kembali" type="number" name="h_tiketp" class="form-control"></input><input style="width:120px;" required id="tkt-tht" type="number" name="t_transport" placeholder="Total" min="2" required class="form-control prc"></input>
                </div>
                @endif

                <div id="TKU" class="form-group">
                  <label>Kendaraan Umum</label><input readonly required value="{{$id->h_ku}}" id="trspt-ht" type="text" name="h_ku" placeholder=" Harga Transportasi" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></input><input id="trspt-tht" type="text" hidden name="t_ku" placeholder="Total" required onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></input>
                </div>

                <div id="UP" class="form-group">
                  <label>Uang Penginapan</label><input type="text" name="n_penginapan" placeholder="Nama Penginapan" class="form-control"></input><input id="pgp-jml" type="number" name="j_penginapan" placeholder="Jumlah" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></input><input id="pgp-ht" type="number" name="h_penginapan" placeholder="Harga Tetap" class="form-control"></input><input id="pgp-st" type="text" name="t_penginapan" placeholder="Total" class="form-control prc"></input>
                </div>

                <div id="HN" class="form-group">
                </div>
                  <label>Uang Harian</label>
                  <input min="0" id="hn-jml" name="j_hn" type="number" placeholder="Jumlah" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></input>
                  <input id="hn-ht" readonly value="{{$id->h_hn}}" name="h_hn" placeholder="Harga Tetap" class="form-control"></input>
                  <input id="hn-st" type="number" name="t_hn" placeholder="Total" class="form-control prc"></input>

                <div id="FD" class="form-group">
                  <label>Full Day</label><input id="fd-jml" type="number" name="j_fd" placeholder="Jumlah" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></input><input id="fd-ht" readonly value="{{$id->h_fd}}" type="number" name="h_fd" placeholder="Harga Tetap" class="form-control"></input><input id="fd-st" type="number" name="t_fd" placeholder="Total" class="form-control prc"></input>
                </div>

                <div id="FB" class="form-group">
                  <label>Full Board</label><input id="fb-jml" type="number" name="j_fb" placeholder="Jumlah" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></input><input id="fb-ht" readonly value="{{$id->h_fb}}" type="number" name="h_fb" placeholder="Harga Tetap" class="form-control"></input><input id="fb-st" type="number" name="t_fb" placeholder="Total" class="form-control prc"></input>
                </div>

                <div id="diklat" class="form-group">
                  <label>Diklat</label><input id="dkl-jml" type="number" name="j_diklat" placeholder="Jumlah" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></input><input id="dkl-ht" readonly value="{{$id->h_diklat}}" type="number" name="h_diklat" placeholder="Harga Tetap" class="form-control"></input><input id="dkl-st" type="number" name="t_diklat" placeholder="Total" class="form-control prc"></input>
                </div>

                <div class="form-group">
                <label>Representatif</label></input><input id="rpr-jml" type="number" name="j_rpr" placeholder="Jumlah" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></input><select id="rpr-ht" type="number" name="h_rpr"><option hidden value="">- Eselon 1 / 2 -</option><option value="150000">150000</option><option value="200000">200000</option></select><input id="rpr-st" type="text" name="t_rpr" placeholder="Total" class="form-control prc"></input>
                </div>

                <div class="form-group">
                    <input hidden name="t_uh" id="result"></input>
                </div>

                <div class="form-group">
                    <input hidden name="t_all" id="t_keseluruhan"></input>
                </div>

                <div class="form-group">
                    <input hidden size="150" id="terbilang" name="terbilang"></input>
                </div>

                <input type="hidden" name="id_event" value="{{ $id->id_event }}">
                <input hidden name="status" value="0"></input>

                <div class="form-group">
                    <div class="col-md-2 col-md-offset-5">
        <center>
          <a style="margin-left: -25px;" href="{{ url('/admin/dashboard') }}"><button>Cancel</button></a>
          <button type="submit">Tambah Pengikut</button>
        </center>
      </div>
    </div>
  </form>

   

  <script type="text/javascript">
      $(".livesearch").chosen();
  </script>

          <script>
                $("#pegawai").change(function () {
                        $("#nama").html("<option value='{{$id -> pejabat}}' selected>{{$id -> pejabat}}</option>");
                        $("#bendahara").html("<option value='{{$id -> bendahara}}' selected>{{$id -> bendahara}}</option>");
                        $("#nip_bendahara").html("<option value='{{$id -> nip_bendahara}}' selected>{{$id -> nip_bendahara}}</option>");
                });

        </script>

    <script type="text/javascript">
    $('#pegawai').change(function(){
    var tujuanID = $(this).val();    
    if(tujuanID){
          $.ajax({
             type:"GET",
             url:"{{url('admin/get-nip')}}?id="+tujuanID,
             success:function(res){               
              if(res){
                  $("#nip_pegawai").empty();
                  $.each(res,function(key,value){
                      $("#nip_pegawai").append('<h4>NIP</h4><input readonly required name="nip" value="'+key+'"></input>');
                  });
             
              }else{
                 $("#nip_pegawai").empty();
              }
             }
          });
        }  
      });
    </script>

      <script type="text/javascript">
    $('#pegawai').change(function(){
    var tujuanID = $(this).val();    
    if(tujuanID){
        $.ajax({
           type:"GET",
           url:"{{url('admin/get-jabatan')}}?id="+tujuanID,
           success:function(res){               
            if(res){
                $("#jabatan").empty();
                $.each(res,function(key,value){
                    $("#jabatan").append('<h4>Jabatan</h4><input readonly name="jabatan" value="'+key+'"></input>');
                });
           
            }else{
               $("#jabatan").empty();
            }
           }
        });
    }  
   });
  </script>

    <script type="text/javascript">
    $('#pegawai').change(function(){
    var tujuanID = $(this).val();    
    if(tujuanID){
        $.ajax({
           type:"GET",
           url:"{{url('admin/get-pangkat')}}?id="+tujuanID,
           success:function(res){               
            if(res){
                $("#pangkat").empty();
                $.each(res,function(key,value){
                    $("#pangkat").append('<h4>Pangkat</h4><input readonly name="pangkat" value="'+key+'"></input>');
                });
           
            }else{
               $("#pangkat").empty();
            }
           }
        });
    }  
   });
  </script>

    <script type="text/javascript">
    $('#pegawai').change(function(){
    var tujuanID = $(this).val();    
    if(tujuanID){
        $.ajax({
           type:"GET",
           url:"{{url('admin/get-tingkat')}}?id="+tujuanID,
           success:function(res){               
            if(res){
                $("#tingkat").empty();
                $.each(res,function(key,value){
                    $("#tingkat").append('<h4>Tingkat</h4><input readonly name="biaya" value="'+key+'"></input>');
                });
           
            }else{
               $("#tingkat").empty();
            }
           }
        });
    }  
   });
  </script>


  <script language="javascript" src="{{ asset('js/operasi.js') }}"></script>
  <script language="javascript" src="{{ asset('js/terbilang.js') }}"></script>
  <script language="JavaScript" src="{{ asset('js/jquery-1.4.4.min.js') }}"></script>
  <script language="JavaScript" src="{{ asset('js/jquery.jsonSuggest-2.js') }}"></script>

        </div>
    <div class="box-body">
  </div>
</section>
@endsection
