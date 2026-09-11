import 'preline'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import HSRemoveElement from "@preline/remove-element/non-auto";
HSRemoveElement.autoInit();


import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";

Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", () => {
    const myDropzone = new Dropzone("#my-dropzone", {
        url: document.querySelector('#my-dropzone').action,
        paramName: 'file',
        chunking: true,
        forceChunking: true,
        parallelUploads: 3,
        chunkSize: 1000000,
        autoProcessQueue: true,
        init: function () {
            this.on("complete", (file) => {
                if (myDropzone.getQueuedFiles().length > 0 && myDropzone.getUploadingFiles().length === 0) {
                    myDropzone.processQueue();
                }
            });
            this.on("queuecomplete", () => alert("All files uploaded successfully!"));
            this.on("sending", (file, xhr, formData) => {
                const acaraId = document.querySelector('input[name="acara_id"]')?.value;
                if (acaraId) formData.append("acara_id", acaraId);
            });
        }
    });
});
