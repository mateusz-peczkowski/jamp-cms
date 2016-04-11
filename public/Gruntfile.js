module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    clean: ["js", "css", "images"],
    mkdir: {
        all: {
            options: {
                mode: 0777,
                create: ['css', 'js', 'images']
            },
        }
    },
    jshint: {
      options: {
        globals: {
            jQuery: true
        }
      },
      all: ['Gruntfile.js', '/js/*.js', '/js/*/*.js']
    },
    compass: {
      dist: {
        options: {
          sassDir: 'assets/sass',
          cssDir: 'css',
          outputStyle: 'compressed'
        }
      }
    },
    coffee: {
      compile: {
        files: {
          'js/app.js': 'assets/coffee/*.coffee'
        }
      }
    },
    imagemin: {
        dynamic: {
            options: {
                optimizationLevel: 3,
                svgoPlugins: [{removeViewBox: false}],
            },
            files: [{
                expand: true,
                cwd: 'assets/images/',
                src: [
                  '**/*.{png,jpg,gif}',
                  '*.{png,jpg,gif}'
                ], // Actual patterns to match
                dest: 'images/'                  // Destination path prefix
            }]
        }
    },
    copy: {
        main: {
            expand: true,
            cwd: 'assets',
            src: [
              'js/**',
              'js/**/**'
            ],
            dest: ''
        }
    },
    // cssmin: {
    //     options: {
    //         shorthandCompacting: true,
    //         roundingPrecision: -1
    //     },
    //     target: {
    //         files: {
    //           'css/keyframes.min.css': [
    //             'assets/css/keyframes.css'
    //           ]
    //         }
    //     }
    // },
    watch: {
      sass: {
        files: [
          'assets/sass/*.sass',
          'assets/sass/*.scss'
        ],
        tasks: ['compass']
      },
      jscopy: {
        files: [
          'assets/js/**',
          'assets/js/**/**'
        ],
        tasks: ['copy']
      },
      styles: {
          files: ['assets/css/*.css'],
          tasks: ['cssmin']
      },
      js: {
        files: [
          'assets/js/*.js',
          'Gruntfile.js'
        ],
        tasks: ['jshint']
      },
      coffee: {
          files: ['assets/coffee/*.coffee'],
          tasks: 'coffee'
      },
      images: {
          files: [
            'assets/images/*.{png,jpg,gif}',
            'assets/images/**/*.{png,jpg,gif}'
          ],
          tasks: ['imagemin']
      }
    }
  });

  // Load the Grunt plugins.
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-mkdir');

  // Register the default tasks.
  grunt.registerTask('default', ['clean','mkdir','copy',/*'cssmin',*/'compass','coffee','imagemin','jshint']);
};