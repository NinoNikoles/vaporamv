module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            styles: {
                files: [
                    'src/scss/*.scss',
                    'src/scss/**/*.scss'
                ],
                tasks: [
                    'sass:build'
                ]
            },
            scripts: {
                files: [
                    //'node_modules/jquery/dist/jquery.js'
                ],
                tasks: [
                    'uglify:build'
                ]
            }
        },
        sass: {
            build: {
                src: ['src/scss/main.scss'],
                dest: 'public/assets/css/main.css',
            },
            dist: {
                src: ['src/scss/main.scss'],
                dest: 'public/assets/css/main.css',
            }
        },
        uglify: {
            options: {
                sourceMap: false
            },
            build: {
                files: {
                    //'public/build/js/jquery.js': ['node_modules/jquery/dist/jquery.js']
                }
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-node-sass');

    // Default task(s).
    grunt.registerTask('build', [
        'sass:build',
        'uglify:build',
        'watch']);
    grunt.registerTask('default', ['build']);

};
