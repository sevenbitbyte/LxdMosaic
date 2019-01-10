    <!-- Modal -->
<div class="modal fade" id="modal-cloudConfig-create" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Cloud Config</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
              <label> Name </label>
              <input class="form-control" name="name" />
          </div>
          <div class="form-group">
              <label> Namespace </label>
              <input class="form-control" name="namespace" />
          </div>
          <div class="form-group">
              <label> Description </label>
              <textarea class="form-control" name="description"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="createCloudConfig">Create</button>
      </div>
    </div>
  </div>
</div>
<script>
$("#modal-cloudConfig-create").on("click", "#createCloudConfig", function(){

    let nameInput =   $("#modal-cloudConfig-create input[name=name]");
    let namespaceInput =   $("#modal-cloudConfig-create input[name=namespace]");
    let descriptionInput = $("#modal-cloudConfig-create textarea[name=description]");

    let nameVal =  nameInput.val();
    let namespaceVal =  namespaceInput.val();
    let descriptionVal =  descriptionInput.val();

    if(nameVal == ""){
        makeToastr(JSON.stringify({state: "error", message: "Please provide name"}));
        nameInput.focus();
        return false;
    } else if(namespaceVal == ""){
        makeToastr(JSON.stringify({state: "error", message: "Please provide namespace"}));
        namespaceInput.focus();
        return false;
    }

    descriptionVal = descriptionVal == "" ? "" : descriptionVal;

    let x = {
        name: nameVal,
        namespace:  namespaceVal,
        description:  descriptionVal
    };

    ajaxRequest(globalUrls.cloudConfig.create, x, (response)=>{
        response = makeToastr(response);
        if(response.state == "error"){
            return false;
        }
        loadCloudConfigTree();
        $("#modal-cloudConfig-create").modal("toggle");
    });
});
</script>