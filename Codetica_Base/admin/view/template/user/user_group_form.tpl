<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-user-group" data-toggle="tooltip" title="Guardar" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="Cancelar" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1>Grupos de Usuarios</h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i>Formulario Grupos de Usuarios</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user-group" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Nombre</label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Nombre" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php  } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Acceso</label>
            <div class="col-sm-10">
              <div class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($permissions as $permission) { ?>
                <div class="checkbox">
                  <label>
                    <?php if (in_array($permission, $access)) { ?>
                    <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" checked="checked" />
                    <?php echo $permission; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" />
                    <?php echo $permission; ?>
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
              <a style="cursor:pointer" onclick="$(this).parent().find(':checkbox').prop('checked', true);">Seleccionar todo</a> / <a style="cursor:pointer" onclick="$(this).parent().find(':checkbox').prop('checked', false);">Deseleccionar todo</a></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Edición</label>
            <div class="col-sm-10">
              <div class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($permissions as $permission) { ?>
                <div class="checkbox">
                  <label>
                    <?php if (in_array($permission, $modify)) { ?>
                    <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" checked="checked" />
                    <?php echo $permission; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" />
                    <?php echo $permission; ?>
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
              <a style="cursor:pointer" onclick="$(this).parent().find(':checkbox').prop('checked', true);">Seleccionar todo</a> / <a style="cursor:pointer" onclick="$(this).parent().find(':checkbox').prop('checked', false);">Deseleccionar todo</a></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 