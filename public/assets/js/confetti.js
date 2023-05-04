function confetti({
    colors = ['#0087ff', '#ff003c', '#ffd500', '#1aff8c'],
    shapes = ['square', 'circle'],
    count = 200,
    spread = 200,
    duration = 3000,
    size = 15,
    zIndex = 100,
  } = {}) {
    const random = (min, max) => Math.random() * (max - min) + min;
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');
    const elements = [];
  
    const shapeFunctions = {
      square: (context, size) => {
        context.rect(-size / 2, -size / 2, size, size);
      },
      circle: (context, size) => {
        context.arc(0, 0, size / 2, 0, 2 * Math.PI);
      },
    };
  
    const createElements = () => {
      for (let i = 0; i < count; i++) {
        const element = {
          x: window.innerWidth / 2,
          y: window.innerHeight / 2,
          angle: random(0, 2 * Math.PI),
          velocity: random(100, 500),
          color: colors[Math.floor(random(0, colors.length))],
          shape: shapes[Math.floor(random(0, shapes.length))],
          size: random(size - 5, size + 5),
          rotation: random(0, 2 * Math.PI),
          scale: { x: 1, y: 1 },
          time: random(0, duration),
        };
  
        element.direction = {
          x: Math.cos(element.angle) * element.velocity,
          y: Math.sin(element.angle) * element.velocity,
        };
  
        elements.push(element);
      }
    };
  
    const animate = () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
      context.clearRect(0, 0, canvas.width, canvas.height);
  
      elements.forEach((element) => {
        const { x, y, color, shape, size, rotation, scale } = element;
        const shapeFunction = shapeFunctions[shape];
  
        context.save();
        context.translate(x, y);
        context.rotate(rotation);
      })}}