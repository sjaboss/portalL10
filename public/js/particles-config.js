particlesJS('particles-js', {
  particles: {
    number: {
      value: 50,
      density: {
        enable: true,
        value_area: 1000
      }
    },
    color: {
      value: ['#ffffff', '#2196f3', '#00bcd4']
    },
    shape: {
      type: 'circle',
      stroke: {
        width: 0,
        color: '#ffffff'
      }
    },
    opacity: {
      value: 0.3,
      random: true,
      anim: {
        enable: true,
        speed: 1,
        opacity_min: 0.1,
        sync: false
      }
    },
    size: {
      value: 0.4, 
      random: true,
      anim: {
        enable: true,
        speed: 2,
        size_min: 0.2, 
        sync: false
      }
    },
    line_linked: {
      enable: true,
      distance: 80,
      color: '#ffffff',
      opacity: 0.2,
      width: 0.1 
    },
    move: {
      enable: true,
      speed: 1,
      direction: 'none',
      random: true,
      straight: false,
      out_mode: 'bounce',
      bounce: true,
      attract: {
        enable: true,
        rotateX: 600,
        rotateY: 1200
      }
    }
  },
  interactivity: {
    detect_on: 'canvas',
    events: {
      onhover: {
        enable: true,
        mode: 'bubble'
      },
      onclick: {
        enable: true,
        mode: 'push'
      },
      resize: true
    },
    modes: {
      bubble: {
        distance: 80,
        size: 0.6, 
        duration: 2,
        opacity: 0.3,
        speed: 3
      },
      push: {
        particles_nb: 2
      }
    }
  },
  retina_detect: true
});
