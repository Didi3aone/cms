<script type="text/javascript">
	// var source = 
	var lists = function () {
	    var table_id = "#dataTable";
	    var ajax_source = "<?= site_url('manager/category/list_all_data'); ?>";
	    var url = "<?= site_url('manager/category/'); ?>";
	    var path_image_url = "<?= site_url();?>"
	    var columns = [
	        {"data": "kategori_id" },
	        {"data": "name" },
	        {"data": "created_date"},
	        {
	            "title": "Action",
	            "class": "text-center",
	            "data": null,
	            "sortable": false,
	            "render": function(data, type, full) {
	                var edit =  '<td>';
	                    edit +=  ' <a href="'+ url + 'edit/' + full.kategori_id + '" class="btn btn-primary btn-circle" rel="tooltip" title="Edit Group" data-placement="top" ><i class="fa fa-pencil"></i></a>' +
	                             ' <a href="'+ url +'delete" data-id ="' + full.kategori_id + '" data-name ="' + full.name + '" class="btn btn-danger btn-circle delete-confirm" rel="tooltip" title="Delete Group" data-placement="top" ><i class="fa fa-trash-o"></i></a>';
	                    edit +=  '</td>';

	                return edit;
	            }
	        },
	    ];
	    setup_daterangepicker(".date-range-picker");
    	init_datatables (table_id, ajax_source, columns);

    //on delete action button click.
    $(document).on("click", ".delete-confirm", function(e) {
        e.stopPropagation();
        e.preventDefault();
        var url = $(this).attr("href");
        var data_id = $(this).data("id");
        var data_name = $(this).data("name");

        title = 'Delete Confirmation';
        content = 'Do you really want to delete ' + data_name + ' ?';

        swal({
            title: title,
            text: content,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
        }).then(function () {
            // alert();
            $.ajax({
                type: "post",
                url: url,
                cache: false,
                data: { id: data_id },
                dataType: 'json',
                beforeSend: function() {
                    $('.loading-box').css("display", "block");
                },
                success: function(data) {
                    console.log(data);
                    $('.loading-box').css("display", "none");

                    if (data.is_error == true) swal("Error!", data.error_msg, "error");
                    else {
                        $.smallBox({
                            title: '<strong>' + data.notif_title + '</strong>',
                            content: data.notif_message,
                            color: "#659265",
                            iconSmall: "fa fa-check fa-2x fadeInRight animated",
                            timeout: 2000
                        }, function() {
                            $(document).trigger("popup-confirm:success", [url,data_id,data]);
                        });
                    }
                },
                error: function() {
                    $('.loading-box').css("display", "none");
                    swal("Error!", "Something Went wrong", "error");
                }
            });
        }).catch(swal.noop);;

    });

    //on reactivate action button click.
    $(document).on("click", ".reactivate-confirm", function(e) {
        e.stopPropagation();
        e.preventDefault();
        var url = $(this).attr("href");
        var data_id = $(this).data("id");
        var data_name = $(this).data("name");

        title = 'Re-activate Confirmation';
        content = 'Do you really want to re-activate ' + data_name + ' ?';

        popup_confirm (url, data_id, title, content);

    });

    //on popup confirm trigger success.
    $(document).on("popup-confirm:success", function (e, url, data_id){
        $("#dataTable").dataTable().fnClearTable();
    });
};

$(document).ready(function() {
    lists();
});

</script>