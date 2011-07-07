yaCMS
=====
A learning project developed while learning at [yap-phpro](https://github.com/OriginalCopy/yap-phpro-book "yap-phpro")

Documentation
=============
Auto-generated documentation using Doxygen can be found at [yaCMS Doc-Site](http://paullik.github.com/yaCMS/index.html)

Doxygen configuration can be found in `/yacms_docs.cfg`

Modules
=======
This CMS is mainly module based, login, logout, and every other functionality is
based on these(and other) modules.

Adding modules
==============
1. First off you have to add your new module's metadata and data in
   `/src/modules.php`(please read that docblock)
2. In `/src/modules/` you have to create a folder named like your module's name
   and in that folder you have to create all the files specified in
   `modules.php`
3. See the result by accessing: `index.php?show=your_new_module`

License
=======
(C) Copyright 2011 PauLLiK

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/.
