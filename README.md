
# Fetch Post & Design UI -Elementor-add-ons

This plugin is basically create elementor widget. The plugin is about set & design HTML Structure of Post. Admin can fetch latest 3 post of any of the Custom post type and able to set the UI on its own way.


## Demo

- [Click me to view demo](https://youtu.be/qPK_nVzHP0c)


## Prerequisites

- You need to install and activate [Elementor Website Builder](https://wordpress.org/plugins/elementor/) plugin
## Instructions

To fetch the post data there is some expression require to use.So here is the expression had to set to 
show the particular data of the posts.

- To show post title use
```bash  
{post_title}
 ```
- To show post excerpt use
```bash
{post_excerpt}
```

- To show post feature image use
```bash
{post_image}
```

- To show post date use
```bash
{post_date}
```
- To show post date with different format.
  - For e.g need to show in this format *March 10, 2001, 5:16 pm* then need to write as below expression
  - Make Sure need to put space(both side) in the second argument
```bash
{post_date, F j, Y, g:i a }
```

- To get permalink of the post use
```bash
{post_permalink}
```

## Features
- Fetch the Post & show post data using expressions
- All expressions through which post data show is mention in
  Instructions sections
- Admin can set the expressions & HTML structure on its own way
- Admin can able to design the UI easily as required
## Authors

- [Sohil Chamadia](https://sohilchamadia8.wordpress.com/)

