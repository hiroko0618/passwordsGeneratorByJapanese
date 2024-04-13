FROM php:7.4.8-apache

ENV MECAB_VERSION 0.996
ENV IPADIC_VERSION 2.7.0-20070801
ENV mecab_url https://drive.google.com/uc?export=download&id=0B4y35FiV1wh7cENtOXlicTFaRUE
ENV ipadic_url https://drive.google.com/uc?export=download&id=0B4y35FiV1wh7MWVlSDBCSXZMTXM
ENV build_deps 'curl git bash file sudo openssh-server'
ENV dependencies 'openssl'

RUN apt update \
    && apt install -y --no-install-recommends ${build_deps} \
    && apt install ${dependencies} \
    && apt install -y ${dependencies} libmecab2 \
    && curl -SL -o mecab-${MECAB_VERSION}.tar.gz ${mecab_url} \
    && tar zxf mecab-${MECAB_VERSION}.tar.gz \
    && cd mecab-${MECAB_VERSION} \
    && ./configure --enable-utf8-only --with-charset=utf8 \
    && make \
    && make install \
    && cd \
    && curl -SL -o mecab-ipadic-${IPADIC_VERSION}.tar.gz ${ipadic_url} \
    && tar zxf mecab-ipadic-${IPADIC_VERSION}.tar.gz \
    && cd mecab-ipadic-${IPADIC_VERSION} \
    && ./configure --with-charset=utf8 \
    && make \
    && make install \
    && cd \
    && git clone --depth 1 https://github.com/neologd/mecab-ipadic-neologd.git \
    && mecab-ipadic-neologd/bin/install-mecab-ipadic-neologd -n -y \
    && rm -rf \
    	mecab-${MECAB_VERSION}* \
	mecab-${IPADIC_VERSION}* \
	mecab-ipadic-neologd

ENV build_deps_phpmecab autoconf git
COPY ./php/php.mecab.ini /usr/local/etc/php/conf.d/
RUN apt update \
    && apt install -y --no-install-recommends autoconf git \
    && apt-get install -y libmecab2 \
    && git clone https://github.com/rsky/php-mecab.git \
    && cd ./php-mecab/mecab \
    && phpize \
    && ./configure --with-php-config=/usr/local/bin/php-config --with-mecab=/usr/local/bin/mecab-config \
    && make \
    && make test \
    && make install \
    && cd \
    && rm -rf php-mecab \
    && apt remove -y ${build_deps_phpmecab}
