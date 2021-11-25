<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Generate Your file texte with each String has a Qr Code And DownLoad
            😎
          </div>

          <div class="card-body">
            <div v-if="success != ''" class="alert alert-success" role="alert">
              {{ success }}
            </div>
            <form @submit="formSubmit" enctype="multipart/form-data">
              <strong>File:</strong> 

              <input
                style="display: none"
                type="file"
                @change="onFileChange"
                ref="fileInput"
              />
              <button @click="$refs.fileInput.click()" class="btn mr-3">
                Pick File
              </button>

              <button class="btn btn-success mr-3">Generate</button>
            </form>
           
            
            <v-btn  class="btn btn-info mr-5" @click="onDownlod" >Download </v-btn>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
   
<script>
import axios from "axios";
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
     file: "",
      success: "",
     
    };
  },
  methods: {
    onFileChange(e) {
      console.log(e.target.files[0]);
      this.file = e.target.files[0];
    },
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      formData.append("file", this.file);

      axios
        .post("http://localhost:8000/api/generate-qrcode", formData, config)
        .then(function (response) {
          currentObj.success = response.data.success;
          window.location.reload();
        })
        .catch(function (error) {
          currentObj.output = error;
        });
    },
     onDownlod() {
     window.location.href="http://localhost:8000/api/zip"
    },
     },
};
</script>
