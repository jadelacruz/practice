/**
 * Created by Ph_DEV090 on 12/18/2017.
 */
$(document).ready(function () {
   function register() {
       return {
           init: function () {
               this.setUp();
               this.setEvent();
           },
           setUp: function () {
               this.oAvatar = $('#avatar');
               this.oAvatarImg = $('#avatarImg');
           },
           setEvent: function () {
               this.oAvatar.change(this.uploadAvatar);
           },
           uploadAvatar: function () {
               var self = oRegister;
               if (typeof (FileReader) !== "undefined") {
                   self.oAvatarImg.attr('src', '');
                   var reader = new FileReader();
                   reader.onloadend = function (e) {
                       var sImgBase64 = reader.result;
                       if (self.isImage(sImgBase64) === true) {
                           var fFileSizeKb = (e.total / 1000);
                           if (fFileSizeKb > 5000) {
                               self.oAvatar.val('');
                               alert('Maximum size for image is 5MB only');
                           } else {
                               self.oAvatarImg.attr('src', e.target.result);
                           }
                       } else {
                           self.oAvatar.val('');
                           alert('Invalid file!');
                       }
                   };
                   reader.readAsDataURL($(this)[0].files[0]);
               } else {
                   alert("This browser does not support FileReader.");
               }
           },
           isImage: function (sBase64) {
               return sBase64.substr(5, 5) === 'image';
           }
       }
   };


   var oRegister = new register();
   oRegister.init();
});