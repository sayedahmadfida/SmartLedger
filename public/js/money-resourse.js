function deleteResourseDetail(event) {
    Swal.fire({
        title: "Are you sure?",
        text: "Want to delete details?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {

            $('#delete-money-resourses-detail').submit();
        }
    });
}