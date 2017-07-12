import Post from './views/BlogPost';
import Home from './views/Home';

export const routes = [
  { path: '/', component: Home },
  { path: '/:slug', component: Post, name: 'job', props: true },
];
