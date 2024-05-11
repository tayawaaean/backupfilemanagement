function logActivity(author, jobTitle, description, action) {
    var currentDate = new Date().toISOString().slice(0, 19).replace('T', ' ');
    $.ajax({
        url: '../files_activity_log.php',
        method: 'POST',
        data: {
            author: author,
            jobTitle: jobTitle,
            dateTime: currentDate,
            description: description,
            action: action
        },
        success: function(response) {
            console.log('Activity logged successfully.');
        },
        error: function(xhr, status, error) {
            console.error('Error logging activity:', error);
        }
    });
}
