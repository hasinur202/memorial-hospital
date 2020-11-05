<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="nav-tabs-custom border0" id="tabs">
   
    <div class="tab-content">
        <?php if ($this->rbac->hasPrivilege('add_medicine_stock', 'can_view')) { ?>
            <div class="tab-pane active">   
                <table class="table table-striped table-bordered table-hover example" id="detail" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('pending') . " " . $this->lang->line('qty'); ?></th>
                            <th><?php echo $this->lang->line('status'); ?></th>


                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($result as $detail) {
                            ?>
                            <tr>
                            <td>
                                <input style="border: none;" type="number" readonly="" name="pending_qty" value="<?php echo $detail->temp_qty ?>" >
                                    
                                <input type="hidden" name="pharmacy_id" class="form-control" value="<?php echo $detail->id ?>">
                            </td>

                            <td >
                                <input style="border: none;" type="text" readonly="" name="pending_qty" value="<?php echo $detail->status ?>" >
                            </td>

                            <td>
                                <?php if ($this->rbac->hasPrivilege('add_medicine_stock', 'can_delete')) { ?>

                             <!--  <button type="submit" class='btn btn-default btn-xs' title="<?php echo $this->lang->line('pharmacy'); ?>" > Approve 
                               </button> -->

                               <button type="submit" id="formstockpendingbtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info btn-sm"><?php echo $this->lang->line('approve'); ?></button>



                                <?php } ?>
                            </td>

                            </tr>
                            <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } if ($this->rbac->hasPrivilege('medicine_bad_stock', 'can_view')) { ?>
            <div class="tab-pane" id="bad_stock">   
                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('outward') . " " . $this->lang->line('date'); ?></th>
                            <th><?php echo $this->lang->line('batch') . " " . $this->lang->line('no'); ?></th>

                            <th><?php echo $this->lang->line('expire') . " " . $this->lang->line('date'); ?></th>
                            <th class="text-right"><?php echo $this->lang->line('quantity'); ?></th>

                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        // if(!empty($badstockresult)){
                        foreach ($badstockresult as $stockdetail) {
                            ?>
                            <tr>
                                <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($stockdetail->outward_date)); ?></td>
                                <td ><?php echo $stockdetail->batch_no ?></td>
                                <td><?php echo $stockdetail->expiry_date ?></td>
                                <td class="text-right"><?php echo $stockdetail->quantity ?></td>
                                <td class="text-right"><?php if ($this->rbac->hasPrivilege('medicine_bad_stock', 'can_delete')) { ?> <a href="#" class="btn btn-default btn-xs" data-toggle="tootip" title="<?php echo $this->lang->line('delete'); ?>" onclick="delete_badstock('<?php echo $stockdetail->id ?>', '<?php echo $stockdetail->pharmacy_id ?>')"><i class="fa fa-trash"></i></a><?php } ?></td>
                            </tr>
                            <?php
                        } //}
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#detail").DataTable({
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        titleAttr: 'Copy',
                        title: $('.download_label').html(),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',

                        title: $('.download_label').html(),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        title: $('.download_label').html(),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',
                        title: $('.download_label').html(),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $('.download_label').html(),
                        customize: function (win) {
                            $(win.document.body)
                                    .css('font-size', '10pt');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        },
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        titleAttr: 'Columns',
                        title: $('.download_label').html(),
                        postfixButtons: ['colvisRestore']
                    },
                ]
            });
        });


    </script>

