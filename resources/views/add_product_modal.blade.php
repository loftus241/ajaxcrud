
  
  <!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="addProductForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="errMsContainer mb-3">

                </div>

                <div class="form-group">
                    <label for="name">Produt name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group mt-2">
                    <label for="name">Produt price</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add_product">Save product</button>
              </div>
            </div>
          </div>
    </form>
  </div>