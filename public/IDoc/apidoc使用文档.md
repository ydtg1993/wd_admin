## 安装步骤
## 先安装npm
## npm安装案例
- 安装gcc  yum install gcc gcc-c++  【必须有】
- 下载node国内镜像（推荐）  wget https://npm.taobao.org/mirrors/node/v10.14.1/node-v10.14.1-linux-x64.tar.gz  【也可以选其他的】
- 解压：tar -xvf  node-v10.14.1-linux-x64.tar.gz 
- 移动: mv node-v10.14.1-linux-x64 /usr/local/node    【路径自选和下面配置配套就行】
- 添加环境变量： vi /etc/profile
在文件最后添加以下配置：
export NODE_HOME=/usr/local/node  
export PATH=$NODE_HOME/bin:$PATH
- 刷新配置：source /etc/profile
- 验证结果：
node -v  
npm -v

- 安装apidoc :npm install apidoc -g
- 使用生成文档 apidoc -i api/ -o doc/ 【本项目再 public/IDoc目录下执行】
- 参考网站：https://zhuanlan.zhihu.com/p/83487114
- 参考网站：https://zhuanlan.zhihu.com/p/83487114