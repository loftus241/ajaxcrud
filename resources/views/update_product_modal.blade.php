 <!-- Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="post" id="updateProductForm">
        @csrf
        <input type="hidDen" id="up_id">

        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Upadate Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="errMsContainer mb-3">

                </div>

                <div class="form-group">
                    <label for="up_name">Produt name</label>
                    <input type="text" class="form-control" id="up_name" name="up_name">
                </div>
                <div class="form-group mt-2">
                    <label for="up_price">Produt price</label>
                    <input type="text" class="form-control" id="up_price" name="up_price">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_product">update product</button>
              </div>
            </div>
          </div>
    </form>
  </div>