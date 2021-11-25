<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Generate Your file texte with each String has a Qr Code And DownLoad
            😎
          </div>

          <div class="card-body" >
            <div v-if="success != ''" class="alert alert-success"  role="alert">
              {{ success }}
            </div>
            <form @submit="formSubmit" enctype="multipart/form-data">
              <strong class="mt-5">File:</strong> 

              <input
                style="display: none"
                type="file"
                @change="onFileChange"
                ref="fileInput"
              />
              <button @click="$refs.fileInput.click()" class="btn ">
                Pick File
              </button>

              <button class="btn btn-success mr-3">Generate</button>
              <p class="text-danger mt-5">**You must put file .txt  In file.txt contains List of Strings Separated with space " " </p>
            </form>
            <div v-if="isDisabled"  style="display: flex; justify-content: flex-end"><button   class="btn btn-warning" @click="onDownlod"  >Download Zip🤐</button></div>
            
            
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
      isDisabled: false
     
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
          currentObj.isDisabled =  true;
       
          
           
              
        })
        .catch(function (error) {
          currentObj.output = error;
        });
    },
     onDownlod() {
       axios({
    url: 'http://localhost:8000/api/zip',
    method: 'GET',
    responseType: 'blob',
}).then((response) => {
     var fileURL = window.URL.createObjectURL(new Blob([response.data]));
     var fileLink = document.createElement('a');
  
     fileLink.href = fileURL;
     fileLink.setAttribute('download', 'AllQRCode.zip');
     document.body.appendChild(fileLink);
   
     fileLink.click();
});
     
     
    },

     },
};
</script>
