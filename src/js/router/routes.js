import Post from '../views/BlogPost';
import Home from '../views/Home';

export const routes = [
  { path: '/', component: Home },
  { path: '/blog', component: Post, name: 'post', props: true },
];
