import Blog from '../views/BlogList';
import Post from '../views/BlogPost';
import Home from '../views/Home';

export const routes = [
  { path: '/', component: Home },
  { path: '/blog', component: Blog, name: 'bloglist', props: true },
  { path: '/blog/:slug', component: Post, name: 'blogPost', props: true },
];
