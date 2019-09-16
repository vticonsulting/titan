class Facebook {
    enable () {
        $(document).ready(_.bind(function () {
            let that = this;
            $('.facebook_share_btn').click(e => {
                let theButton = $(e.currentTarget);
                let title = theButton.attr('data-title');
                let desc = theButton.attr('data-desc');
                let url = theButton.attr('data-url');
                let image = theButton.attr('data-image');
                that.shareOnFacebook(title, desc, url, image);
            });
        }, this));
    }

    shareOnFacebook (title, desc, url, image) {
        var userId = $('input[name="participant_user_id"]').val();
        FB.ui({
            method: 'share',
            href: url
        },
        function (response) {
            if (response && !response.errorMessage) {
                $.get(
                    '/users/user_successful_facebook_share/' + userId,
                    { data: 'success' },
                    function (data) {
                        return data;
                    }
                );
            }
        });
    }
};

module.exports = Facebook;
