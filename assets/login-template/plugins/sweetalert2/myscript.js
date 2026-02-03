const flashData = $(".flash-data").data("flashdata");

if (flashData == "user-gagal") {
	Swal.fire({
		text: "Maaf, Username yang anda masukan salah.",
		icon: "error",
		showConfirmButton: false,
		timer: 2200,
	});
}

if (flashData == "passw-gagal") {
	Swal.fire({
		text: "Maaf, Password yang anda masukan salah.",
		icon: "error",
		showConfirmButton: false,
		timer: 2200,
	});
}

if (flashData == "login-berhasil") {
	Swal.fire({
		text: "Login berhasil silahkan menjalankan Aplikasi SI IKAN TERI.",
		icon: "success",
		showConfirmButton: false,
		timer: 2200,
	});
}
