// Sweet Alert
const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal({
        title: 'Sukses', position: "top-end",
        text: 'Data berhasil ' + flashData,
        type: 'success',
		  showConfirmButton: false,
		  timer: 2500
    });
}

// Sweet Alert
const flashGagal = $('.flash-data-gagal').data('flashdata');

if (flashGagal) {
    Swal({
        title: 'Gagal', position: "top-end",
        text: 'Data gagal disimpan, ' + flashGagal,
        type: 'error'
    });
}

const flashKomen = $('.flash-data-komen').data('flashdata');
if (flashKomen) {
	Swal({
        title: 'Sukses', position: "top-end",
        text: 'Komentar berhasil ' + flashKomen,
        type: 'success',
		  showConfirmButton: false,
		  timer: 2500
    });
}
 

// tombol-hapus
$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin',
        text: "data akan dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })

}); 

// Preview Gambar 
function previewGmb() {
    const sampul = document.querySelector("#image");
    const sampulLabel = document.querySelector(".custom-file-input");
    const imgPreview = document.querySelector(".img-preview");

    sampulLabel.textContent = sampul.files[0].name;

    const fileSampul = new FileReader();
    fileSampul.readAsDataURL(sampul.files[0]);

    fileSampul.onload = function (e) {
        imgPreview.src = e.target.result;
    };
}

// Input / Browse file 
$('.custom-file-input').on('change', function () {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
