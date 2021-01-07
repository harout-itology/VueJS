function sendNowJs(_this) {
    if (_this.SMSData.length < 1) {
        _this.errorMessageHeaderColor = "modal-header text-danger";
        _this.errorMessageHeader = "Error Message";
        _this.errorMessage = "Please select at least one Template.";
        $('#myErrorModal').modal('show');

    }
    else {
        _this.SendNowDisabled = true;
        _this.showloading = true;
        axios.post('/api/sendSms', {
            recipientNumber: _this.form.recipientNumber,
            username: _this.form.username,
            SMSData: _this.SMSData
        })
            .then(function (response) {
                _this.errorMessageHeaderColor = "modal-header text-success";
                _this.errorMessageHeader = "Success";
                _this.errorMessage = "Action Successfully added to the Queue for " + _this.form.recipientNumber;
                $('#myErrorModal').modal('show');
                _this.SMSData = [];
                _this.SMSText = [];
                _this.$refs.tree.handleRecursionNodeChilds(_this.$refs.tree, node => {
                    if (node.model) {
                        node.model.selected = false;
                        node.model.opened = false;
                    }
                });
            })
            .catch(function (error) {
                _this.errorMessageHeaderColor = "modal-header text-danger";
                _this.errorMessageHeader = "Error Message";
                _this.errorMessage = "";
                $.each(error.response.data.errors, function(key, value) {
                    _this.errorMessage += value + "  ";
                });
                $('#myErrorModal').modal('show');
            })
            .finally(() => {
                _this.SendNowDisabled = false;
                _this.showloading = false;
            });
    }
};

export { sendNowJs };

